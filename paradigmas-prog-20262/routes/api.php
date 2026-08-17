<?php

use Iluminate\Support\Facades\Route;

Route::get('/health', function()){
    return response()->json('Minha API tá on');
});