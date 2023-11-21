<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\Collections\CityCollection;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): CityCollection
    {
        return new CityCollection(City::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {

        City::create($request->all());
        return response()->json([
            'message' => 'City is created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): CityResource
    {
        return new CityResource(City::query()->where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json([
            'message' => 'City is deleted'
        ]);
    }
}
