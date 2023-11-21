<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\Collections\CountryCollection;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): CountryCollection
    {
        return new CountryCollection(Country::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Country::query()->create($request->all());
        return response()->json([
            'message' => 'Country is created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return new CityResource($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country): \Illuminate\Http\JsonResponse
    {
        $country->delete();
        return response()->json([
            'message' => 'Country is remove!'
        ]);
    }
}
