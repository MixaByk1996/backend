<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

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
           Project::query()->create($request->all());
//        $project = new Project();
//        $project->name = $request->get('name');
//        $project->description = $request->get('description');
//        $company_id = $request->get('company_id');
//        $company = Company::query()->where('id', $company_id)->first();
//        $project->company = $company;
//        $project->save();

        return response()->json([
            'message' => 'Project is added'
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
            'error' => "empty!"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->where('id', $id)->first();
        $project?->update($request->all());
        return response()->json([
            'message'=> 'Project is updated'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->where('id', $id)->first();
        $project?->delete();
        return response()->json([
            'message'=> 'Project is deleted'
        ]);
    }
}
