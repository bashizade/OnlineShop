<?php

use Illuminate\Support\Facades\Route;

Route::prefix('panel')->group(function (){
    Route::prefix('product')->group(function (){
        Route::get('/',[\App\Http\Controllers\ProductController::class,'index'])->name('panel.product');
        Route::post('/create',[\App\Http\Controllers\ProductController::class,'create'])->name('panel.product.create');
        Route::put('/update',[\App\Http\Controllers\ProductController::class,'update'])->name('panel.product.update');
        Route::delete('/delete',[\App\Http\Controllers\ProductController::class,'delete'])->name('panel.product.delete');
    });

    Route::prefix('category')->group(function (){
        Route::get('/',[\App\Http\Controllers\CategoryController::class,'index'])->name('panel.category');
        Route::post('/create',[\App\Http\Controllers\CategoryController::class,'create'])->name('panel.category.create');
        Route::put('/update',[\App\Http\Controllers\CategoryController::class,'update'])->name('panel.category.update');
        Route::delete('/delete',[\App\Http\Controllers\CategoryController::class,'delete'])->name('panel.category.delete');
    });

    Route::prefix('payment')->group(function (){
        Route::get('/',[\App\Http\Controllers\PaymentController::class,'index'])->name('panel.payment');
        Route::put('/update',[\App\Http\Controllers\PaymentController::class,'update'])->name('panel.payment.update');
    });
});

Route::prefix('user')->group(function (){
    Route::get('/',[\App\Http\Controllers\UserController::class,'index'])->name('user');
    Route::get('/invoice',[\App\Http\Controllers\UserController::class,'user_invoice'])->name('user.invoice');

    Route::prefix('cart')->group(function (){
        Route::post('/add',[\App\Http\Controllers\CartController::class,'add'])->name('user.cart.add');
        Route::delete('/remove',[\App\Http\Controllers\CartController::class,'remove'])->name('user.cart.remove');
    });
});

Route::get('/invoice',[\App\Http\Controllers\InvoiceController::class,'index'])->name('invoice');

Route::post('/user/payment/callback',[\App\Http\Controllers\PaymentController::class,'callback'])->name('callback');
