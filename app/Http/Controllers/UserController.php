<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        User::query()->create([
            'login' => $request->get('login'),
            'password' => Hash::make($request->get('password')),
            'rules' => $request->has('rules') ? $request->get('rules') : "USER"
        ]) ;
        return response()->json([
            'message' => 'User is created!'
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('login', $request->get('login'))->first();

        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->get('device_name'))->plainTextToken;

    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'You are exiting'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): UserResource
    {
        $user = User::query()->where('id', $id)->first();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->where('id', $id)->first();
        $user->update($request->all());
        return response()->json([
            'message' => 'Данные пользователя обновлены'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
