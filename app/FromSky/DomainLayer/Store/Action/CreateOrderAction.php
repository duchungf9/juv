<?php


namespace App\FromSky\DomainLayer\Store\Action;


use Illuminate\Support\Str;


use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderItem;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;

class CreateOrderAction
{
    private Cart $cart;
    /**
     * @var ShippingCalculator
     */
    private $shippingCalculator;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;

    }

    function execute()
    {
        return $this->createOrder($this->cart);
    }

    // order creation
    public static function createOrder($cart)
    {
        $billing_address_id = ($cart->billing_address_id) ? $cart->billing_address_id : $cart->shipping_address_id;
        $order              = Order::create([
            'user_id'                    => $cart->user_id,
            'cart_id'                    => $cart->id,
            'products_cost'              => $cart->getTotalProducts(),
            'payment_fee'                => $cart->getPaymentFeeAmount(),
            'shipping_cost'              => $cart->getShipping(),
            'shipping_method_id'         => $cart->shipping_method_id,
            'shipping_method'            => optional($cart->shipping_method)->title,
            'vat_cost'                   => $cart->getVat(),
            'total_cost'                 => $cart->cartGrandTotal(),
            'billing_address_id'         => $billing_address_id,
            'shipping_address_id'        => $cart->shipping_address_id,
            'billing_formatted_address'  => optional($cart->display_billing_address)->display('<br>'),
            'shipping_formatted_address' => $cart->shipping_address->display('<br>'),
            'discount_amount'            => $cart->getDiscountTotalAmount(),
            'discount_code'              => $cart->discount_code,
            'token'                      => Str::random(32),
            'reference'                  => Order::generateReference(),
            'status_id'                  => Order::ORDER_STATUS_SENT
        ]);


        $cart->status = CART_SENT;
        $cart->save();
        StoreHelper::forgetSessionCart();

        $cart_items = $cart->cart_items()->with('product')->get();

        // order items creation
        foreach ($cart_items as $_item) {

            $price            = StoreHelper::getProductPrice($_item->product, false);
            $reduction_amount = 0;
            $final_price      = $price - $reduction_amount;
            $quantity         = ($_item->quantity) ? $_item->quantity : 1;
            $total_price      = $final_price * $quantity;
            OrderItem::create([
                'order_id'            => $order->id,
                'product_code'        => $_item->product_code,
                'product_title'       => $_item->product->title,
                'product_description' => $_item->product_code . " " . $_item->product->title,
                'quantity'            => $_item->quantity,
                'cartitem_id'         => $_item->id,
                'price'               => $price,
                'reduction_amount'    => $reduction_amount,
                'final_price'         => $final_price,
                'total_price'         => $total_price,

            ]);

            (new DisableUserAbandonmentCartAction(auth_user()))->execute();
        }
        return $order;
    }
}