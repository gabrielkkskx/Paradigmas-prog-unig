<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function __construct(public UserService $userService){}
     
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        // Chama a função index do UserService, passando os dados da requisição como parâmetro
        return response()->json([
            'data' => $this->userService->index($request->all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request){
        // Chama a função store do UserService, passando os dados da requisição como parâmetro
        return response()->json([
            'data' => $this->userService->store($request->all())
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