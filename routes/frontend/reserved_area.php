<?php

use App\FromSky\DomainLayer\Store\Controllers\OrderControllers;
use App\FromSky\Website\Controllers\ReservedAreaController;
use App\FromSky\Website\Controllers\UpdatePasswordController;
use App\FromSky\Website\Controllers\UserAvatarApiController;

Route::get('/dashboard', [ReservedAreaController::class, 'dashboard'])->name('user.dashboard');
Route::get('/profile',   [ReservedAreaController::class, 'profile'])->name('user.profile');
Route::post('/profile',  [ReservedAreaController::class, 'update_profile']);
Route::post('/change-password', [UpdatePasswordController::class, 'update_password'])->name('user.change-password');
Route::get('/order-detail/{order}', [OrderControllers::class, 'show'])->name('order.detail');

Route::get('/address-new', [ReservedAreaController::class, 'addressNew']);
Route::post('/address-new',[ReservedAreaController::class, 'addressCreate']);

Route::post('/avatar',   [UserAvatarApiController::class,'create'])->name('user.avatar-upload');
Route::delete('/avatar', [UserAvatarApiController::class,'delete'])->name('user.avatar-delete');