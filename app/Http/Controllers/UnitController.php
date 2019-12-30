<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;

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
    public function store(UnitRequest $unitRequest)
    {
        # set variable
        $kode = $unitRequest->kode;
        $nama = $unitRequest->nama;
        $posisi = $unitRequest->posisi;

        # set data array
        $unitData = [
            'kode' => $kode,
            'nama' => $nama,
            'posisi' => ''
        ];

        $storeunit = Unit::create($unitData);

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
    public function update(UnitRequest $unitRequest, $id)
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
            'posisi' => ''
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
        var_dump($id);
    }
}
