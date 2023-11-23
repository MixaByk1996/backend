<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\SubprojectCollection;
use App\Http\Resources\SubprojectResource;
use App\Models\Subproject;
use Illuminate\Http\Request;

class SubprojectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): SubprojectCollection
    {
        return new SubprojectCollection(Subproject::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Subproject::query()->create($request->all());
        return response()->json([
            'message' => 'Subproject is added'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subproject $subject): SubprojectResource
    {
        return new SubprojectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subproject $subject): \Illuminate\Http\JsonResponse
    {
        $subject->update($request->all());
        return response()->json([
            'message' => 'Subproject is updated'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subproject $subject): \Illuminate\Http\JsonResponse
    {
        $subject->delete();
        return response()->json([
            'message' => 'Subproject is deleted'
        ]);
    }
}
