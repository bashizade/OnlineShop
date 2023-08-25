@extends('layouts.master')
@section('content')
    <x-slider></x-slider>
    <x-category-cart-carousel></x-category-cart-carousel>
    <div class="mb-5">
        <div class="text-right">
            <span class="bg-[#ef394e] text-white rounded-t-xl p-2">محصولات</span>
        </div>
        <div class="bg-[#ef394e] rounded-xl rounded-tr-none p-1">
            <div class="grid grid-cols-4 gap-4 ">
                <x-product-card></x-product-card>
                <x-product-card></x-product-card>
                <x-product-card></x-product-card>
                <x-product-card></x-product-card>
            </div>
            <div class="text-center my-3">
                <span class="bg-white/60 rounded-xl p-2 text-white">مشاهده بیشتر</span>
            </div>
        </div>
    </div>
@endsection
