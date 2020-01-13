<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Unit;
use App\Models\Kategori;
use App\Models\Tahap;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Auth::guard('pengguna')->User()->role;
        $unit_id = Auth::guard('pengguna')->User()->unit_id;

        $filter_jenis = $request->filter_jenis;
        $filter_unit = $request->filter_unit;
        $filter_kategori = $request->filter_kategori;
        $filter_tahap = $request->filter_tahap;

        $suratMasuk = SuratMasuk::with('unit', 'kategori', 'tahap')
            ->join('kategori', 'kategori_id', '=', 'kategori.id')
            ->orderBy('surat_masuk.created_at', 'desc')
            ->where(function($q) use($filter_jenis, $filter_unit, $filter_kategori, $filter_tahap){
                if($filter_jenis){
                    $q->where('kategori.jenis', $filter_jenis);
                }
                if($filter_unit){
                    $q->where('unit_id', $filter_unit);
                }
                if($filter_kategori){
                    $q->where('kategori_id', $filter_kategori);
                }
                if($filter_tahap){
                    $q->where('tahap_id', $filter_tahap);
                }
            })
            ->paginate(5);

        $jenis = [
            "Dokumen", 
            "Surat Rangga", 
            "Surat Harian",
        ];

        $unit = unit::orderBy('id', 'asc')
            ->where(function($q) use($role, $unit_id){
                if($role == 'Staf'){
                    $q->where('id', $unit_id);
                }
            })
            ->get();
            
        $kategori = kategori::orderBy('jenis', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $tahap = tahap::orderBy('jenis', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view('dashboard', compact('filter_jenis','filter_unit','filter_kategori','filter_tahap','suratMasuk','jenis','unit', 'kategori', 'tahap'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
