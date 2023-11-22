<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    public function register(Request $request)
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

    public function login(Request $request){
        $user = User::query()->where('login', $request->get('login'))->where('password', Hash::make($request->get('password')))->first();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
