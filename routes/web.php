<?php

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Front\ContactUsController;
use App\Http\Controllers\Front\SupporterController;
use App\Http\Controllers\Front\HomePageController;
use App\Http\Controllers\Front\CategoryController;


Route::group(['prefix'=>RouteServiceProvider::Front], function (){
    Route::get('/about-us',[AboutUsController::class,'index'])->name('front.about');
    Route::get('/home',[HomePageController::class,'index'])->name('front.home');
    Route::get('/contact-us',[ContactUsController::class,'index'])->name('front.contact');
    Route::post('/contact-us-store',[ContactUsController::class,'store'])->name('front.contact.store');
    Route::get('/category',[CategoryController::class,'index'])->name('front.category');
    Route::get('/support',[SupporterController::class,'index'])->name('front.support');
});
