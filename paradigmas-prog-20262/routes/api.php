<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

Route::get('/health', function(){
    return response()->json('Minha API tá on');
});

Route::post('/users', function(){
    $data = FacadesRequest::validate([
        'name' => 'required|string|max:50|min:3',
        'email' => 'required|email',
        'password' => 'required|min:4|max:20',
    ]);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
    ]);

    return response()->json([
        'message' => 'Usuário criado com sucesso',
        'data' => $user
    ]);
});

Route::get('/users', function(){
    $users = User::all();

    return response()->json(['data' => $users]);
});

Route::put('/users/{id}', function(){
    $id = FacadesRequest::route('id');

    $data = FacadesRequest::validate([
        'name' => ['sometimes', 'string', 'max:100', 'min:3'],
    ]);
});