<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::orderByCreatedAtDesc()
            ->paginate(5);

        return view('kategori.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(kategoriRequest $kategoriRequest)
    {

        # set variable
        $nama = $kategoriRequest->nama;
        $jenis = $kategoriRequest->jenis;
      

        # set array kategori data
        $kategoriData = [
            'nama' => $nama,
            'jenis' => $jenis,
            
        ];

        # store
        $storekategori = Kategori::create($kategoriData);

        # return to kategori
        return redirect('/kategori')
            ->with([
                'notification' => 'Data berhasil disimpan!'
            ]);
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
        $checkkategoriData = kategori::findOrFail($id);
        $kategori = $checkkategoriData;

        return view('kategori.form_edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(kategoriRequest $kategoriRequest, $id)
    {
        # set variable
        $nama = $kategoriRequest->nama;
        $jenis = $kategoriRequest->jenis;
      

        # set array kategori data
        $kategoriData = [
            'nama' => $nama,
            'jenis' => $jenis,
            
        ];

        # store
        $updatekategori = kategori::where('id', $id)
            ->update($kategoriData);

        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletekategori = kategori::destroy($id);

        return redirect('/kategori')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }
}
