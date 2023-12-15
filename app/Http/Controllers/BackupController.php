<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\BackupCollection;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;

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
        $data = json_decode($request->get('data'), true);
//
//        $arr = [];
//        foreach ($data as $item){
//            $arr[] = json_decode($item);
//        }
//        Log::info(json_decode($data[0]));
        $pdf = PDF::loadView('pdf', compact('data'));
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

    public function delBackup(string $id): \Illuminate\Http\JsonResponse
    {
        $project = Backup::query()->where('id', $id)->first();
        $project->delete();
        return response()->json([
            'message'=> 'Бекап удален'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
