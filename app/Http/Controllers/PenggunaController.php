<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Requests\PenggunaRequest;
use DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Pengguna::select(DB::raw("
                pengguna.*,
                unit.nama AS unit_nama
            "))
            ->orderBy('created_at', 'desc')
            ->join('unit', 'unit.id', '=', 'pengguna.unit_id')
            ->paginate(5);

        return view('pengguna.pengguna', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = unit::orderBy('nama', 'desc')
            ->get();
        return view('pengguna.form_create')->with('unit', $unit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenggunaRequest $penggunaRequest)
    {
        # set variable
        $nip = $penggunaRequest->nip;
        $nama = $penggunaRequest->nama;
        $password = $penggunaRequest->password;
        $unitID= $penggunaRequest->unit_id;
        $role = $penggunaRequest->role;
        $encryptPassword = bcrypt($password);

        # set array
        $data = [
            'nip'=> $nip,
            'nama'=> $nama,
            'password' => $encryptPassword,
            'unit_id'=> $unitID,
            'role' => $role
        ];

        # store pengguna
        $storePengguna = Pengguna::create($data);

        return redirect('/pengguna')
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
        $checkPengguna = Pengguna::findOrFail($id);

        $pengguna = Pengguna::find($id);
        $unit = unit::orderBy('nama', 'desc')
            ->get();

        return view('pengguna.form_edit', compact('pengguna'))->with('unit', $unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PenggunaRequest $penggunaRequest, $id)
    {
        # set variable
        $nip = $penggunaRequest->nip;
        $nama = $penggunaRequest->nama;
        $password = $penggunaRequest->password;
        $unitID= $penggunaRequest->unit_id;
        $role = $penggunaRequest->role;
        $encryptPassword = bcrypt($password);

        # set array
    

        if(!empty($password)) {
            $encryptPassword = bcrypt($password);

            # set array
            $data = [
            'nip'=> $nip,
            'nama'=> $nama,
            'password' => $encryptPassword,
            'unit_id'=> $unitID,
            'role' => $role
            ];

            # update pengguna
            $updatePengguna = Pengguna::where('id', $id)
                ->update($data);
        }else{
            # set array
            $data = [
                'nip' => $nip,
                'nama'=> $nama,
                'role' => $role,
                'unit_id'=> $unitID,
            ];

            # update pengguna
            $updatePengguna = Pengguna::where('id', $id)
                ->update($data);
        }

        return redirect('/pengguna')
            ->with([
                'notification' => 'Data berhasil diubah!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkPengguna = Pengguna::findOrFail($id);

        $deletePengguna = Pengguna::destroy($id);

        return redirect('/pengguna')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }
}
