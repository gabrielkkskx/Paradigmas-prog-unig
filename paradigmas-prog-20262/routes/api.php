<?php

use App\Models\User;
use Iluminate\Http\Request;
use Iluminate\Support\Facades\Request as FacadesRequest;
use Iluminate\Support\Facades\Route;

Route::get('/health', function(){
    return response()->json('Minha API tá on');
});

Route::post('/users', function(){
    $data = FacadesRequest::validate([
        'name' => 'required|string|max:50|min:3',
        'email' => 'required|email',
        'password' => 'required|min:4|max:20',
    ]);

    User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
    ]);

    return response()->json('Usuario criado com sucesso!');
});