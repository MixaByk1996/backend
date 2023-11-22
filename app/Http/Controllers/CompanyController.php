<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\Collections\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): CompanyCollection
    {
        return new CompanyCollection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Company::query()->create($request->all());
        return response()->json([
            'message' => 'Company is added'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): \Illuminate\Http\JsonResponse
    {
        $company->update($request->all());
        return response()->json([
            'message' => 'Company is updated'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): \Illuminate\Http\JsonResponse
    {
        $company->delete();
        return response()->json([
            'message' => 'Company is deleted'
        ], 201);
    }
}
