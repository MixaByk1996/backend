<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\FileCollection;
use App\Http\Resources\FileResource;
use App\Http\Resources\ProjectResource;
use App\Models\Files;
use App\Models\Project;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): FileCollection
    {
        return new FileCollection(Files::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Files::query()->create($request->all());
        return response()->json([
            'message' => 'File is added'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse|FileResource
    {
        $file = Files::query()->where('id', $id)->first();
        if($file){
            return new FileResource($file);
        }
        return response()->json([
            'error' => "empty!"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $files = Files::query()->where('id', $id)->first();
        $files?->update($request->all());
        return response()->json([
            'message'=> 'File is updated'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $files = Files::query()->where('id', $id)->first();
        $files?->delete();
        return response()->json([
            'message' => 'Project is deleted'
        ]);
    }
}
