<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;
use App\Http\Requests\unitRequest;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Unit::orderByCreatedAtDesc()
            ->paginate(5);

        return view('unit.unit', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(unitRequest $unitRequest)
    {
        # set variable
        $kode = $unitRequest->kode;
        $nama = $unitRequest->nama;
        $posisi = $unitRequest->posisi;

        # set data array
        $unitData = [
            'kode' => $kode,
            'nama' => $nama,
            'posisi' => $posisi
        ];

        $storeunit = unit::create($unitData);

        return redirect('/unit');
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
        # check unit and get unit data if exist
        $unit = unit::findOrFail($id);

        return view('unit.form_edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(unitRequest $unitRequest, $id)
    {
        $checkunitData = unit::findOrFail($id);

        # set variable
        $kode = $unitRequest->kode;
        $nama = $unitRequest->nama;
        $posisi = $unitRequest->posisi;

        # set data array
        $unitData = [
            'kode' => $kode,
            'nama' => $nama,
            'posisi' => $posisi
        ];

        $updateunit = unit::where('id', $id)
            ->update($unitData);

        return redirect('/unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkunitData = unit::findOrFail($id);

        $deleteunit = unit::destroy($id);

        return redirect('/unit')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }
}
