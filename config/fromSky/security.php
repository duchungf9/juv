<?php
return [
	/**
	 * Password regex.
	 */
	'password_regex' => '/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!?$*#^\-_~()[\]{}.,:;<>&%@]).*$/',

	/**
	 * Allowed redirect to path.
	 */
	'redirectTo' => [
		'cart',
		'order-submit',
        'cart/address'
	]
];
