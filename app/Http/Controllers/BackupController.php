<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\BackupCollection;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): BackupCollection
    {
       return new BackupCollection(Backup::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Artisan::call('database:backup');
        return response()->json([
            'message' => 'Бекап успешно создан'
        ]);
    }


    public function getPdf(Request $request): \Illuminate\Http\Response
    {
        $data = $request->get('data');
        $pdf = PDF::loadView('pdf', ['data' => $data]);
        return $pdf->download();
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
