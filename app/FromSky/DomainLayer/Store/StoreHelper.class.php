<?php

namespace App\FromSky\DomainLayer\Store;


use Auth;
use Illuminate\Support\Str;

use App\Model\Cart;
use App\Model\Order;
use App\Model\CartItem;
use App\Model\Payment;
use App\Model\Discount;
use App\Model\PaymentMethod;
use App\Model\SpecialPrice;

use App\FromSky\DomainLayer\Store\Payment\PayPal\PayPalHelper;
use App\FromSky\DomainLayer\Store\Payment\PayPal\GFExpressCheckout;


class StoreHelper
{


    public static function isShippingEnabled()
    {
        return config('fromSky.store.shipping.enabled');
    }

    // get order by token
    public static function getOrderByToken($token)
    {
        $order = Order::where('token', $token)->with(['payment', 'billing_address', 'shipping_address'])->first();

        return ($order) ? $order : false;
    }

    /*
    |--------------------------------------------------------------------------
    |  PRODUCTS
    |--------------------------------------------------------------------------
    */

    // product display
    public static function formatPrice($price)
    {
        $formatted_price = number_format(floatval($price), config('fromSky.store.formatting.decimals'), config('fromSky.store.formatting.decimal_separator'), config('fromSky.store.formatting.thousands_separator'));

        if (config('fromSky.store.formatting.prepend_currency')) {
            $formatted_price = config('fromSky.store.currency_symbol') . ' ' . $formatted_price;
        }
        if (config('fromSky.store.formatting.append_currency')) {
            $formatted_price .= ' ' . config('fromSky.store.currency_symbol');
        }

        return $formatted_price;
    }

    public static function getProductPrice($product)
    {
        if ($user = Auth::user()) {
            if ($user->list_code) {
                $list_price = SpecialPrice::where('list_code', $user->list_code)->where('product_code', $product->code)->first();
                if ($list_price) {
                    return $list_price->price;
                }
            }
        }
        return floatval($product->price);
    }

    public static function formatProductPrice($product, $quantity = 1)
    {
        $price = self::getProductPrice($product) ?? 0;
        return self::formatPrice($price * $quantity);
    }


    /*
    |--------------------------------------------------------------------------
    |  CART
    |--------------------------------------------------------------------------
    */

    // cart display
    public static function getCartTotal($cart = false)
    {
        if (!$cart)
            $cart = self::getSessionCart();
        if ($cart) {
            $cart_items = $cart->cart_items()->with('product')->get();
            $total      = 0;
            foreach ($cart_items as $_item) {
                $total += self::getProductPrice($_item->product) * $_item->quantity;
            }
            return round($total, 2);
        }
        return 0;
    }

    public static function formatCartTotal()
    {
        $total = self::getCartTotal();
        return self::formatPrice($total);
    }

    public static function getCartItemCount($cart = false)
    {
        if (!$cart) $cart = self::getSessionCart();

        if ($cart) {
            return $cart->cart_items()->count();
        }
        return 0;
    }

    // cart retrieving
    public static function getSessionCart()
    {
        if (session()->has('cart')) {
            $id = session('cart');

            $cart = Cart::where('status', CART_NEW)->where('id', $id)->withCount('cart_items')->first();
            return ($cart) ? $cart : false;
        }
        return false;
    }

    // cart storing
    public static function setSessionCart($cart)
    {
        session()->put('cart', $cart->id);
    }

    // cart flushing
    public static function forgetSessionCart()
    {
        session()->forget('cart');
    }

    // get open cart
    public static function getUserCart()
    {
        if ($user = Auth::user())
            $cart = Cart::where('status', CART_NEW)->where('user_id', $user->id)->orderBy('created_at', 'DESC')->first();
        return ($cart) ? $cart : false;
    }

    // open a new cart and set it to session
    public static function cartCreate()
    {
        if ($user = Auth::user())
            $cart = Cart::create(['user_id' => $user->id]);

        else
            $cart = Cart::create([]);

        $token = Str::random(56) . '$' . $cart->id;
        $cart->update(['token' => $token]);
        self::setSessionCart($cart);
        return $cart;
    }


    /*
    |--------------------------------------------------------------------------
    |  CART ITEMS
    |--------------------------------------------------------------------------
    */
    // add item from cart
    public static function cartItemAdd($request)
    {
        $cart     = (self::getSessionCart()) ?: self::cartCreate();
        $quantity = data_get($request, 'quantity', 1);

        $cart_item = CartItem::firstOrCreate([
            'cart_id'            => $cart->id,
            'product_code'       => $request['product_code'],
            'product_model_code' => data_get($request, 'product_model_code'),

        ]);

        if ($cart_item) {
            $cart_item->increment('quantity', (int)$quantity);
            return [
                'cart'       => $cart,
                'cart_items' => self::getCartItems(),
                'cart_count' => self::getCartItemCount($cart)
            ];
        }

        return false;
    }

    static function getCartItems()
    {
        $cart = StoreHelper::getSessionCart();
        return ($cart) ? $cart->cart_items()->list()->get()->map(function ($item) {
            $item->product->thumb_image = $item->product->getThumbImage();
            $item->product->url         = $item->product->getPermalink();
            return $item;
        }) : $cart_items = collect([]);
    }

    // remove item from cart
    public static function cartItemRemove($cart_item_id)
    {
        $cart = self::getSessionCart();
        if ($cart) {
            $cart_item = CartItem::find($cart_item_id);
            if ($cart_item && $cart_item->cart_id == $cart->id) {
                $cart_item->delete();
                return [
                    'cart'       => $cart,
                    'cart_count' => self::getCartItemCount($cart)
                ];
            }
        }
        return false;
    }

    public static function updateItemQuantity($request)
    {
        $cart = self::getSessionCart();
        if ($cart) {
            $quantity  = data_get($request, 'quantity', 1);
            $cart_item = CartItem::find($request['id']);
            if ($cart_item && $cart_item->cart_id == $cart->id) {
                $cart_item->update(['quantity' => $quantity]);
                return [
                    'cart'       => $cart,
                    'cart_count' => self::getCartItemCount($cart)
                ];
            }
        }
        return false;
    }


    /*
    |--------------------------------------------------------------------------
    |  PAYMENTS
    |--------------------------------------------------------------------------
    */

    // retrieve available payment methods
    public static function getPaymentMethods()
    {
        return PaymentMethod::active()->get();
    }

    // create payment for order
    public static function createPayment($order_id, $payment_method_id)
    {
        $payment = Payment::create([
            'order_id'          => $order_id,
            'payment_method_id' => $payment_method_id,
        ]);

        return ($payment) ? $payment : false;
    }

    public static function processPayment($payment)
    {
        switch ($payment) {
            case 'paypal':
                $provider = new GFExpressCheckout;

                $provider->setCurrency(config('fromSky.store.currency'));
                $options       = PayPalHelper::getPaypalPaymentOptions();
                $cart          = StoreHelper::getSessionCart();
                $data          = PayPalHelper::getPaypalPaymentData($cart);
                $data['items'] = [];
                $response      = $provider->addOptions($options)->setSimpleExpressCheckout($data, 'false');

                if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                    return [
                        'status' => 'ok',
                        'text'   => $response['paypal_link']
                    ];
                } else {

                    $payment->notes = $response['L_LONGMESSAGE0'];
                    $payment->save();
                    $payment->delete();

                    return [
                        'status' => 'fail',
                        'text'   => $response['L_LONGMESSAGE0']
                    ];
                }
                break;
        }
    }

    public static function confirmPayment($payment, $request)
    {
        switch ($payment) {
            case 'bank':
                break;
            case 'paypal':
                $token    = $request->get('token');
                $PayerID  = $request->get('PayerID');
                $cart     = StoreHelper::getSessionCart();
                $data     = PayPalHelper::getPaypalPaymentData($cart);
                $provider = new GFExpressCheckout;
                $provider->setCurrency(config('fromSky.store.currency'));
                $response = $provider->getExpressCheckoutDetails($token);
                return PayPalHelper::makePaypalPayment($cart, $response, $token, $PayerID);
                break;
        }
    }

}
