<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\kategori;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Http\Requests\kategoriRequest;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(kategoriRequest $kategoriRequest)
    {
        # set faker
        $faker = Faker::create();

        # set variable
        $nama = $kategoriRequest->nama;
        $nomorTelepon = $kategoriRequest->nomor_telepon;
      

        # set array kategori data
        $kategoriData = [
            'nama' => $nama,
            
        ];

        # store
        $storekategori = kategori::create($kategoriData);

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
      

        # set array kategori data
        $kategoriData = [
            'nama' => $nama,
            
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        return response()
            ->json($kategori);
    }
}
