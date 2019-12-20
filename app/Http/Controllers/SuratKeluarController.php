<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Unit;
use App\Models\Kategori;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Http\Requests\SuratKeluarRequest;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratKeluar = SuratKeluar::paginate(5);

        return view('surat_keluar.surat_keluar', compact('suratKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = Unit::all();

        return view('surat_keluar.form_create', compact('unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratKeluarRequest $suratKeluarRequest)
    {
        # set variable
        $nomor = $suratKeluarRequest->nomor;
        $tujuan = $suratKeluarRequest->tujuan;
        $unitID = $suratKeluarRequest->unit_id;
        $kategoriID = $suratKeluarRequest->kategori_id;
        $perihal = $suratKeluarRequest->perihal;
        $tanggalKirim = $suratKeluarRequest->tanggal_kirim;
        $lampiranFile = $suratKeluarRequest->lampiran;

        $findkategoriEmail = kategori::find($kategoriID);
        $kategoriEmail = $findkategoriEmail->email;
        $kategoriName = $findkategoriEmail->nama;

        if (!empty($lampiranFile)) {
            $lampiranFileName = $lampiranFile->getClientOriginalName();
            $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();

            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'tujuan' => $tujuan,
                'perihal' => $perihal,
                'tanggal_kirim' => $tanggalKirim,
                'lampiran' => $lampiranFileName
            ];

            $uploadFileLampiran = Storage::disk('uploads')
                ->putFileAs(
                    'documents/surat-keluar',
                    $lampiranFile,
                    $lampiranFileName
                );

            $updateSuratKeluar = SuratKeluar::create($data);
        }else{
            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'tujuan' => $tujuan,
                'perihal' => $perihal,
                'tanggal_kirim' => $tanggalKirim
            ];

            $updateSuratKeluar = SuratKeluar::create($data);
        }

        return redirect('/surat-keluar')
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
        $checkSuratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar = $checkSuratKeluar;
        $unit = Unit::all();

        return view('surat_keluar.form_edit', compact('suratKeluar', 'Unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratKeluarRequest $suratKeluarRequest, $id)
    {
        # set variable
        $nomor = $suratKeluarRequest->nomor;
        $tujuan = $suratKeluarRequest->tujuan;
        $unitID = $suratKeluarRequest->unit_id;
        $kategoriID = $suratKeluarRequest->kategori_id;
        $perihal = $suratKeluarRequest->perihal;
        $tanggalKirim = $suratKeluarRequest->tanggal_kirim;
        $lampiranFile = $suratKeluarRequest->lampiran;

        if (!empty($lampiranFile)) {
            $lampiranFileName = $lampiranFile->getClientOriginalName();
            $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();

            $checkOldLampiranFile = SuratKeluar::find($id);
            $oldLampiranFile = $checkOldLampiranFile->lampiran;

            if(!empty($oldLampiranFile)){
                $deleteLampiranFile = Storage::disk('uploads')
                    ->delete('documents/surat-keluar/'.$oldLampiranFile);

                $uploadFileLampiran = Storage::disk('uploads')
                    ->putFileAs(
                        'documents/surat-keluar',
                        $lampiranFile,
                        $lampiranFileName
                    );
            }else{
                $uploadFileLampiran = Storage::disk('uploads')
                    ->putFileAs(
                        'documents/surat-keluar',
                        $lampiranFile,
                        $lampiranFileName
                    );
            }

            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'tujuan' => $tujuan,
                'perihal' => $perihal,
                'tanggal_kirim' => $tanggalKirim,
                'lampiran' => $lampiranFileName
            ];

            $updateSuratKeluar = SuratKeluar::where('id', $id)
                ->update($data);
        }else{
            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'tujuan' => $tujuan,
                'perihal' => $perihal,
                'tanggal_kirim' => $tanggalKirim
            ];

            $updateSuratKeluar = SuratKeluar::where('id', $id)
                ->update($data);
        }

        return redirect('/surat-keluar')
            ->with([
                'notification' => 'Data berhasil disimpan!'
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
        $findSuratKeluar = SuratKeluar::findOrFail($id);

        $SuratKeluar = SuratKeluar::find($id);

        # check lampiran file if exist
        if (!empty($SuratKeluar->lampiran)) {
            $deleteLampiranFile = Storage::disk('uploads')
                ->delete('documents/surat-keluar/'.$SuratKeluar->lampiran);
        }

        $deleteSuratKeluar = SuratKeluar::destroy($id);

        return redirect('/surat-keluar')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }
}
