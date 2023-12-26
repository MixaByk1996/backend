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

    public function searchByKeyWord(Request $request): SubprojectCollection
    {
        $search = $request->get('search');
        return new SubprojectCollection(Subproject::query()->where('description', 'like', "%$search%")->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        try {
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
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function updateAllDescriptionById(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $old_val = $request->get('old');
            $new_val = $request->get('new');
            $arr = Subproject::query()->where('template_id', $id)->get();

            foreach ($arr as $item){
                $description = $item->description;
                $new_description = str_replace(strip_tags($old_val), strip_tags($new_val), strip_tags($description));
                $item->description = $new_description;
                $item->save();
            }

            return response()->json([
                'message'=> 'Успешно обновлены'
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        }

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
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $subject = Subproject::query()->where('id', $id)->first();
        $subject->name = $request->get('name');
        $subject->description = $request->get('description');
        $subject->save();
        return response()->json([
            'message' => 'Лист успешно обновлен'
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
            'message' => 'Лист удален'
        ]);
    }
}
