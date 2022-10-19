<?php


namespace App\FromSky\DomainLayer\Store\Payment\PayPal;


use App\FromSky\DomainLayer\Store\Action\CreateOrderAction;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;

/**
 *
 */
class PayPalHelper
{


    public static function getPaypalPaymentOptions()
    {
        $options = [
            'BRANDNAME'    => config('fromSky.website.options.app.name'),
            'LOGOIMG'      => asset('/website/images/logo.png'),
            'CHANNELTYPE'  => 'Merchant',
            'SOLUTIONTYPE' => 'Sole'
        ];

        return $options;
    }

    public static function getPaypalPaymentData($cart)
    {
        $data = [];

        $data['items']      = []; //Carrello solo con totale
        $data['return_url'] = url_locale('/order-payment-confirm/' . $cart->token);
        $data['cancel_url'] = url_locale('/order-payment-cancel/' . $cart->token);
        $data['total']      = $cart->cartGrandTotal();
        $data['noshipping'] = 1;

        return $data;
    }

    public static function makePayPalPayment($cart, $response, $token, $PayerID)
    {

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // Perform transaction on PayPal
            $provider = new GFExpressCheckout;
            $provider->setCurrency(config('fromSky.store.currency'));
            $cart = StoreHelper::getSessionCart();
            $data = self::getPaypalPaymentData($cart);

            $payment_status = $provider->doExpressCheckoutPayment($data, $token, $PayerID);
            // If the transaction is successfully completed
            if (in_array(strtoupper($payment_status['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

                //CREA ORDINE
                $order   = (new CreateOrderAction($cart))->execute();
                $payment = StoreHelper::createPayment($order->id, $cart->payment_method_id);

                $payment->transaction = $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
                $payment->notes       = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
                $payment->is_paid     = 1;
                $payment->save();

                return $order;
            } else {
                return $payment_status['L_LONGMESSAGE0'];
            }
        }
    }
}