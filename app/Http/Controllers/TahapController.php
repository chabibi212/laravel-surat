<?php

namespace App\Http\Controllers;

use App\Models\Tahap;
use Illuminate\Http\Request;
use App\Http\Requests\TahapRequest;

class TahapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahap = Tahap::orderByCreatedAtDesc()
            ->paginate(5);

        return view('tahap.tahap', compact('tahap'));
    }

    public function create()
    {
        return view('tahap.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TahapRequest $TahapRequest)
    {

        # set variable
        $nama = $TahapRequest->nama;
        $jenis = $TahapRequest->jenis;
      

        # set array tahap data
        $tahapData = [
            'nama' => $nama,
            'jenis' => $jenis,
            
        ];

        # store
        $storetahap = Tahap::create($tahapData);

        # return to tahap
        return redirect('/tahap')
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
        $checktahapData = tahap::findOrFail($id);
        $tahap = $checktahapData;

        return view('tahap.form_edit', compact('tahap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahapRequest $TahapRequest, $id)
    {
        # set variable
        $nama = $TahapRequest->nama;
        $jenis = $TahapRequest->jenis;
      

        # set array tahap data
        $tahapData = [
            'nama' => $nama,
            'jenis' => $jenis,
            
        ];

        # store
        $updatetahap = Tahap::where('id', $id)
            ->update($tahapData);

        return redirect('/tahap');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletetahap = tahap::destroy($id);

        return redirect('/tahap')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }
}
