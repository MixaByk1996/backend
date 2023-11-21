<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\AccessListCollection;
use App\Models\AccessList;
use Illuminate\Http\Request;

class AccessListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new AccessListCollection(AccessList::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        AccessList::query()->create($request->all());
        return response()->json([
            'message' => 'IP addess added to white list!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AccessList $accessList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccessList $accessList)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessList $accessList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessList $accessList)
    {
        $accessList->delete();
        return response()->json([
            'message' => 'This IP adress is deleted'
        ]);
    }
}
