<?php namespace App\FromSky\Definition;
interface Definition
{
    const DEFAULT_USER_UNIT = 'km';
    const CART_FIRST_STEP = 'store.cart.step_1';
    const CART_STEP_ADDRESS = 'address';
    const CART_STEP_PAYMENT = 'payment';
    const CART_STEP_RESUME = 'resume';

    const USER_STORAGE_DISK = "users";
}