<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sukoharjo;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sukoharjo::select('kelurahan_id', 'kecamatan_id')
        ->groupBy('kelurahan_id', 'kecamatan_id')
        ->get();

        // cari id kecamatan dan kelurahan
        foreach ($data as $item){
            // check if value is numeric
            if (is_numeric($item->kecamatan_id)) {
                $kecamatan_id = Kecamatan::where('id', $item->kecamatan_id)->first();
            } else {
                $kecamatan_id = Kecamatan::where('name', 'like', '%'.$item->kecamatan_id.'%')
                        ->where('regency_id', 3310)    
                        ->first();
            }

            if (is_numeric($item->kelurahan_id)) {
                $kelurahan_id = Kelurahan::where('id', $item->kelurahan_id)->first();
            } else {
                $kelurahan_id = Kelurahan::where('name', 'like', '%'.$item->kelurahan_id.'%')
                        ->where('district_id', $kecamatan_id->id)  
                        ->first();
            }

            if(!$kecamatan_id || !$kelurahan_id) {
                $array[] = [
                    'kecamatan_id' => $item->kecamatan_id,
                    'kelurahan_id' => $item->kelurahan_id,
                ];
            }else{

                // update data
                Sukoharjo::where('kelurahan_id', $item->kelurahan_id)
                    ->where('kecamatan_id', $item->kecamatan_id)
                    ->update([
                        'kelurahan_id' => $kelurahan_id->id,
                        'kecamatan_id' => $kecamatan_id->id,
                        'provinsi_id' => '33',
                    ]);

            }

        }

        return $array;
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
