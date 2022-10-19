<?php

return [
	'product' => [
		'code' => 'Code',
		'price' => 'Price',
        'sku'   => 'SKU number',
        'on_sale' => "On Sale"
	],

	'cart' => [
        'checkout' => 'Checkout',
        'continue' => 'Continue',
        'confirm' => 'Confirm your data',
		'title' => 'Shopping Bag',
		'total' => 'Total',
		'empty' => 'Your shopping bag is empty',
		'buy' => 'Checkout',
        'back' => 'Back to the store',
        'number_of_items' => 'Items',
        'show_detail'=>'show details',
        'optional' => 'optional',
        'with_tax'=>'VAT Incl.',
        'table' => [
            'code' => 'Code',
            'name' => 'Product',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
            'actions' => 'Actions'
		],
        'step'=>[
            'next_payment' =>'Next: Shipping  & Payment Methods',
            'next_send' =>'Next: Send Order ',
            'next_confirm' =>'Next: Confirm Order ',
            'shipping_and_payment' => 'Shipping & Payment Methods',
            'edit'=>'Modify',
            'edit_address'=>'Modify Addresses',
            'edit_payment_method' => 'Edit Payment Method',
            'edit_shipping_and_payment' => 'Modify Shipping & Payment'
        ]
	],

	'shipping' => [
        'free_label' => 'Free',
		'free' => 'Free shipping',
		'free_from' => 'Free shipping from order amount more  than :AMOUNT',
		'disclaimer' => 'Consegna gratuita in Italia , 7 euro Europa,per le altre nazioni contattaci',
        'method' => 'Shipping Method',
	],

	'items' => [
		'add' => 'Add to cart',
        'are_you_sure_to_remove' => 'Are you sure to remove this item from your cart?',
		'remove' => 'Remove from cart'
	],

	'alerts' => [
		'add_success' => 'Product added to your cart',
		'add_fail' => 'Unable to add the product to the cart',
		'remove_success' => 'Product removed from cart',
		'remove_fail' => 'Unable to remove the product from the cart',
		'cart_invalid' => 'Invalid cart',
		'cart_empty' => 'The cart is empty',
		'order_success' => 'Order submitted correctly',
		'order_fail' => 'Unable to submit the order',
        'payment_cancel' => 'Your payment request has been canceled',
		'payment_fail' => 'Payment failed',
		'payment_already_paid' => 'The order has already been paid',
		'payment_success' => 'Payment successful',
        'shipping_address_invalid' => 'Shipping address error<br> :ERROR',
	],

    'notification'=>[
        'order_resent'=>'Order Email confirmation has been resent to your email address'
    ],

	'order' => [
		'guard' => 'An account is required to continue',
		'login' => 'Login',
        'success' => 'Order completed successfully.',
        'reference' => 'Order reference:  ',
        'info'=>'For any information please contact us by entering the following order number in the request:',
        'number'=>'Order number',
		'register' => 'Create a new account',
		'title' => 'Order Summary',
        'order' => 'Order',
        'date' => 'Date',
		'back' => 'Back to cart',
		'resume' => 'Products review',
		'addresses' => 'Addresses',
		'totals' => 'Costs review',
		'confirm' => 'Send Your Order',
		'payment' => 'Payment method',
		'billing' => 'Billing address',
		'billing_different_address' => 'The billing address is the same as the shipping address',
		'shipping' => 'Shipping address',
		'products_cost' => 'Products cost',
		'shipping_cost' => 'Shipping cost',
        'registered_user' => 'Registered user',
        'registered_user_login_message'  => 'Log in to recall your saved details and speed up your purchase.',
        'guest_checkout'  => 'Guest Checkout',
        'guest_checkout_countinue'  => 'Continue as Guest',
        'guest_checkout_message'  => 'Don\'t have any account? You can check out without logging in. 
        You will be able to register after completing your order for faster checkout and access to order history. ',

        'vat_cost' => 'VAT',
		'total_cost' => 'Order total',
		'discount' => [
			'title' => 'Discount coupon',
			'insert' => 'If you have a discount coupon code type it here.',
			'valid' => 'Coupon found: discount %s',
			'invalid' => 'This code is invalid.',
            'add' =>' Add a discount code',
            'enter'=>'Enter discount code',
            'apply'=>'Apply discount code',
            'delete'=>'Delete',
            'delete_coupon' => 'Delete Coupon',
            'are_you_sure_to_remove' => 'Are you Sure to remove your coupon from your cart?',
            'coupon_deleted' => 'Coupon deleted',
		]
	],

	'payment' => [
		'title' => 'Payment result',
		'pay' => 'Pay the order',
		'method' => 'Payment Method',
		'paid' => 'Paid',
		'unpaid' => 'Unpaid',
		'back' => 'Back to the order',
        'payment_fee' => 'This payment method has an additional fee:'
	],

	'address' => [
		'new' => 'Add new address',
		'fields' => [
			'street' => 'Street',
			'number' => 'Number',
			'zip_code' => 'ZIP',
			'city' => 'City',
			'province' => 'Province/State',
			'country' => 'Country',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'vat' => 'VAT number'
		],
		'save' => 'Save'
	],

	'dashboard' => [
        'welcome' => 'Hi',
		'orders' => 'Orders',
		'orders_empty' => 'There are no orders yet, go to the Shop ',
		'addresses' => 'Addresses',
		'table' => [
			'products' => 'Products',
			'total' => 'Total',
			'payment' => 'Payment',
			'paid' => 'Paid',
			'date' => 'Date',
			'order' => 'Order',
			'view' => 'View',
			'resend_email' => 'Resend<br/>Email',
		]
	],

	'paypal' => [
		'items_total' => 'Products total'
	]
];
