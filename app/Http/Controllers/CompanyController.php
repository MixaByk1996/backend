<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\Collections\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
//        Company::query()->create($request->all());
        $validatedData = $request->validate([
            'image_data' => 'required|file|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        $name = $validatedData['image_data']->getClientOriginalName();
        Storage::disk('public')->putFileAs('/img/uploads/companies', new File($validatedData['image_data']), pathinfo($validatedData['image_data']->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $validatedData['image_data']->getClientOriginalExtension());

        $image_name = pathinfo($validatedData['image_data']->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $validatedData['image_data']->getClientOriginalExtension();
        $obj = new Company();
        $obj->name = $request->get('name');
        $obj->photo_url = Storage::url('img/uploads/companies/' . $image_name );
        $obj->description = $request->get('description');
        $obj->save();
        return response()->json([
            'message' => 'Компания успешно добавлена'
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
