<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\SubprojectCollection;
use App\Http\Resources\SubprojectResource;
use App\Models\Files;
use App\Models\Project;
use App\Models\Subproject;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
//        foreach ($files as $file){
//            Storage::disk('public')->putFileAs('subprojects/uploads/', new File($file), pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file->getClientOriginalExtension());
//            $image_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file->getClientOriginalExtension();
//            $fileObj = new Files();
//            $fileObj->name = $image_name;
//            $fileObj->type = $file->getClientOriginalExtension();
//            $fileObj->file_url = Storage::url('subprojects/uploads/' . $image_name );
//            $subproject->files()->save($fileObj);
//        }

        return response()->json([
            'message' => 'Подпроект добавлен'
        ], 201);
    }

    public function addFileInSubProject(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $subproject = Subproject::query()->where('id', $id)->first();
        $files = $request->file('files_add');
        foreach ($files as $file){
            Storage::disk('public')->putFileAs('/subprojects/uploads/', new File($file), pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file->getClientOriginalExtension());
            $image_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file->getClientOriginalExtension();
            $fileObj = new Files();
            $fileObj->name = $image_name;
            $fileObj->type = $file->getClientOriginalExtension();
            $fileObj->file_url = Storage::url('subprojects/uploads/' . $image_name );
            $subproject->files()->save($fileObj);
        }
        return response()->json([
            'message' => 'Файлы успешно добавлен'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): SubprojectResource
    {
        $subject = Subproject::query()->where('id', $id)->first();
        return new SubprojectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subproject $subject): \Illuminate\Http\JsonResponse
    {
        $subject->update($request->all());
        return response()->json([
            'message' => 'Подпроект успешно обновлен'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subproject $subject): \Illuminate\Http\JsonResponse
    {
        $subject->tags()->delete();
        $subject->files()->delete();
        $subject->delete();
        return response()->json([
            'message' => 'Подпроект удален'
        ]);
    }
}
