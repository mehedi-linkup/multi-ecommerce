<?php

namespace App\Traits;

Trait AdminPermission {
    
    public function checkRequestPermission() 
    {
        if (empty(auth()->user()->role->permission['permission']['slider']['list'])  && \Route::is('admin.sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['add'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['edit'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['view'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['delete'])  && \Route::is('sliders') ||

            empty(auth()->user()->role->permission['permission']['product']['list'])  && \Route::is('admin.products') ||
            empty(auth()->user()->role->permission['permission']['product']['add'])  && \Route::is('admin.product.create')
        ) {
           return response()->view('admin.home');
        }
    }
}
