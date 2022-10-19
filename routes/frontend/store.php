<?php

use App\FromSky\Website\Controllers\Store\OrderSendController;
use App\FromSky\Website\Controllers\Store\OrderResultController;
use App\FromSky\Website\Controllers\Store\OrderPaymentController;

use App\FromSky\DomainLayer\Store\Controllers\CartController;
use App\FromSky\DomainLayer\Store\Controllers\MainStoreController;
use App\FromSky\DomainLayer\Store\Controllers\AddressStepController;
use App\FromSky\DomainLayer\Store\Controllers\ConfirmStepController;
use App\FromSky\DomainLayer\Store\Controllers\PaymentMethodStepController;
use App\FromSky\DomainLayer\Store\Controllers\Payment\StorePaymentManagerController;

use App\FromSky\DomainLayer\Store\Notifications\NewOrderNotification;

use App\FromSky\DomainLayer\Store\Api\StoreAPIController;
use App\FromSky\DomainLayer\Store\Api\CouponDeleteController;
use App\FromSky\DomainLayer\Store\Api\CouponValidateController;
use App\FromSky\DomainLayer\Store\Api\ResendOrderNotification;


Route::get('/cart/', CartController::class)->middleware('storeenabled')->name('cart');
Route::get('/cart/address', [AddressStepController::class, 'view'])->middleware('storeenabled', 'auth')->name('cart.step_1');
Route::post('/cart/address',[AddressStepController::class, 'store'])->middleware('storeenabled');
Route::get('/cart/payment', [PaymentMethodStepController::class, 'view'])->middleware('storeenabled')->name('cart.payment');
Route::post('/cart/payment',[PaymentMethodStepController::class, 'store'])->middleware('storeenabled');
Route::get('/cart/resume',  [ConfirmStepController::class, 'view'])->middleware('storeenabled')->name('cart.resume');
Route::post('/cart/resume', [ConfirmStepController::class, 'view'])->middleware('storeenabled');

Route::get('/order-send/', [StorePaymentManagerController::class, 'handle'])->middleware(['storeenabled', 'auth'])->name('order.send');
Route::get('/order-confirm/{token}', [OrderResultController::class, 'view'])->middleware(['storeenabled', 'auth'])->name('order.confirm.success');

Route::get('/order-payment-confirm/{token?}', [OrderPaymentController::class, 'orderPaymentConfirm'])->middleware(['storeenabled', 'auth'])->name('order.payment.cancel');
Route::get('/order-payment-cancel/{cart:token}', [OrderPaymentController::class, 'cancel'])->middleware(['storeenabled', 'auth'])->name('order.payment.cancel');


Route::get('/order/mailable/{order:token}', function (\App\Model\Order $order) {
    return (new NewOrderNotification($order))->toMail($order->user);
});


Route::get('/order-login/', [MainStoreController::class,'orderLogin'])->name('cart.login')->middleware(['storeenabled']);
Route::get('/order-submit/',[MainStoreController::class,'orderSubmit'])->middleware(['storeenabled'])->name('cart.detail');


/*
|--------------------------------------------------------------------------
| STORE API
|--------------------------------------------------------------------------
*/

Route::group([], function () {

    // store section
    Route::post('api/store/cart-item-add', [StoreAPIController::class, 'storeCartItemAdd']);
    Route::post('api/store/cart-item-remove', [StoreAPIController::class, 'storeCartItemRemove']);
    Route::post('api/store/cart-item-update', [StoreAPIController::class, 'updateItemQuantity']);
    /** TODO DELETE */
    //Route::get('api/store/order-calc', [StoreAPIController::class, 'storeOrderCalc']);
    Route::get('api/store/validate-coupon', CouponValidateController::class);
    Route::delete('api/store/coupon-remove', CouponDeleteController::class);
    Route::get('api/store/resend-order-notification/{order:token}', ResendOrderNotification::class);
});