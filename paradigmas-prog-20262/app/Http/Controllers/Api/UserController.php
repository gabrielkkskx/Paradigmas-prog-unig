<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
     
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $data = $request->all();

        /* $users = User::query()
        ->where('name', $data['name'])
        ->get(); */

        $users = User::query()->where(function ($query) use ($data) {
            if (data_get($data['name'])) {
                $query->where('name', 'like', '%' . $data['name'] . '%');
            }

            if (data_get($data['email'])) {
                $query->where('email', 'like', '%' . $data['email'] . '%');
            }
        })->get();

        return response()->json(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request){
        $data = $request->validated();

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