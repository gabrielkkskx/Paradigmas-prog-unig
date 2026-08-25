<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
     
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $users = User::all();

        return response()->json(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:4', 'max:20']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $user = User::find($id);

        return response()->json(['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:100', 'min:3'],
            'email' => ['sometimes', 'email'],
            'password' => ['sometimes', 'min:4', 'max:20']
        ]);

        $user = User::find($id);

        $user->update($data);

        return response()->json(['data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $user = User::find($id);

        $user->delete();

        return response('Usuário deletado com sucesso!');
    }
}