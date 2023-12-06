<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\TagsConnection;
use App\Models\Project;
use App\Models\Subproject;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): TagsConnection
    {
        return new TagsConnection(Tags::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $module = $request->get('module');
        $id = $request->get('id');
        $name = $request->get('name');
        $tag = new Tags();
        if($module == 'PROJECT'){
            $project = Project::query()->where('id', $id)->first();
            $tag->name = $name;
            $project->tags()->save($tag);
        }
        else{
            $project = Subproject::query()->where('id', $id)->first();
            $tag->name = $name;
            $project->tags()->save($tag);
        }
        return response()->json([
            'message' => 'Тег добавлен'
        ]);
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
