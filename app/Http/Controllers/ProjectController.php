<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Company;
use App\Models\Files;
use App\Models\Project;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ProjectCollection
    {
        return new ProjectCollection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
           $project = Project::query()->create($request->all());

           $files = $request->file('files_add');
           foreach ($files as $file){
               Storage::disk('public')->putFileAs('/projects/uploads/', new File($file), pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file->getClientOriginalExtension());
               $image_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file->getClientOriginalExtension();
               $fileObj = new Files();
               $fileObj->name = $image_name;
               $fileObj->type = $file->getClientOriginalExtension();
               $fileObj->file_url = Storage::url('projects/uploads/' . $image_name );
               $project->files()->save($fileObj);
           }

        return response()->json([
            'message' => 'Проект успешно добавлен'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse|ProjectResource
    {
        $project = Project::query()->where('id', $id)->first();
        if($project){
            return new ProjectResource($project);
        }
        return response()->json([
            'error' => "Пусто!"
        ]);
    }

    public function getUpdate(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->where('id', $id)->first();
        $project->name = $request->get('name');
        $project->description = $request->get('description');
        $project->save();
        return response()->json([
            'message'=> 'Проект обновлен'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->where('id', $id)->first();
        $project->name = $request->get('name');
        $project->description = $request->get('description');
        $project->save();
        return response()->json([
            'message'=> 'Проект обновлен'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->where('id', $id)->first();
        $project?->delete();
        return response()->json([
            'message'=> 'Проект удален'
        ]);
    }
}
