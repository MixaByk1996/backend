<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\TemplatesListCollection;
use App\Http\Resources\TemplatesListResource;
use App\Models\TemplatesList;
use Illuminate\Http\Request;

class TemplatesListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): TemplatesListCollection
    {
        return new TemplatesListCollection(TemplatesList::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse|string
    {
        try {
            TemplatesList::query()->create($request->all());
            return response()->json([
               'message' => 'Шаблон добавлен успешно'
            ]);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): TemplatesListResource
    {
        $obj = TemplatesList::query()->where('id', $id)->first();
        return new TemplatesListResource($obj);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse|string
    {
        try {
            $update = TemplatesList::query()->where('id', $id)->first();
            $update->update($request->all());
            return response()->json([
                'message' => 'Шаблон обновлен'
            ]);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse|string
    {
        try {
            $update = TemplatesList::query()->where('id', $id)->first();
            $update?->delete();
            return response()->json([
                'message' => 'Шаблон добавлен успешно'
            ]);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
