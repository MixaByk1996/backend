<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\AccessListCollection;
use App\Models\AccessList;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Exceptions\BadResponse;

class AccessListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AccessListCollection
    {
        return new AccessListCollection(AccessList::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $obj = new AccessList();
        $obj->address = $request->get('address');
        $obj->save();
        return response()->json([
            'message' => 'IP адрес добавлен в белый список!'
        ]);
    }

    public function addIpAddress(Request $request): \Illuminate\Http\JsonResponse
    {
        $obj = new AccessList();
        $obj->address = $request->ip();
        $obj->save();
        return response()->json([
            'message' => 'IP адрес добавлен в белый список!'
        ]);
    }

    public function hashIpAddress(Request $request): \Illuminate\Http\JsonResponse
    {
        $ip = $request->ip();
        $obj = AccessList::query()->where('address', $ip)->first();
        if($obj){
            return response()->json([
                'message' => $ip
            ]);
        }
        else{
            return response()->json([
                'message' => 'Текущий ip адрес не включен в белый лист'
            ]);
        }

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
    public function destroy(AccessList $accessList): \Illuminate\Http\JsonResponse
    {
        $accessList->delete();
        return response()->json([
            'message' => 'This IP adress is deleted'
        ]);
    }

    public function deleteById(mixed $id): \Illuminate\Http\JsonResponse
    {
        $object = AccessList::query()->where('id', $id)->first()->delete();
        return response()->json([
            'message' => 'IP адрес успешно удален'
        ]);
    }
}
