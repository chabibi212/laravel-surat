<?php

namespace App\Http\Controllers;

use Mail;
use Crypt;
use Storage;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Kategori;
use App\Models\Tahap;
use App\Models\SuratMasuk;
use App\Mail\SuratMasukMail;
use Illuminate\Http\Request;
use App\Services\LampiranFileService;
use App\Http\Requests\SuratMasukRequest;
use Auth;
use DB;

class SuratMasukController extends Controller
{
    protected $lampiranFileServe;

    public function __construct(LampiranFileService $lampiranFileService)
    {
        $this->lampiranFileServe = $lampiranFileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Auth::guard('pengguna')->User()->role;
        $unit_id = Auth::guard('pengguna')->User()->unit_id;

        $filter_unit = $request->filter_unit;
        $filter_kategori = $request->filter_kategori;
        $filter_year = $request->filter_year;
        $filter_month = $request->filter_month;
        $filter_text = strtolower($request->filter_text);

        $suratMasuk = SuratMasuk::with('unit', 'kategori', 'tahap')
            ->where(function($q) use($filter_unit, $filter_kategori, $filter_text, $filter_year, $filter_month){
                if($filter_unit){
                    $q->where('unit_id', $filter_unit);
                }
                if($filter_kategori){
                    $q->where('kategori_id', $filter_kategori);
                }
                if($filter_text){
                    $q->whereRaw(DB::raw("(
                        LOWER(nomor) LIKE '%".$filter_text."%'
                        OR LOWER(perihal) LIKE '%".$filter_text."%'
                    )"));
                }
                if($filter_year){
                    $q->whereRaw(DB::raw("(
                        DATE_FORMAT(tanggal_terima,'%Y') = '".$filter_year."'
                    )"));
                }
                if($filter_month){
                    $q->whereRaw(DB::raw("(
                        DATE_FORMAT(tanggal_terima,'%m') = '".$filter_month."'
                    )"));
                }
            })
            ->orderBy('created_at', 'desc')
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

        return view('surat_masuk.surat_masuk', compact('filter_year','filter_unit','filter_kategori','filter_text','suratMasuk','jenis','unit', 'kategori', 'tahap'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Auth::guard('pengguna')->User()->role;
        $unit_id = Auth::guard('pengguna')->User()->unit_id;

        $unit = unit::orderBy('nama', 'asc')
            ->where(function($q) use($role, $unit_id){
                if($role == 'Staf'){
                    $q->where('id', $unit_id);
                }
            })
            ->get();
        $kategori = kategori::orderBy('jenis', 'asc')
            ->orderBy('nama', 'desc')
            ->get();
        $tahap = tahap::orderBy('jenis', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view('surat_masuk.form_create', compact('unit', 'kategori', 'tahap'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratMasukRequest $request)
    {
        $telaahFile = $request->telaah;
        $telaahFileName = 'telaah_'. date('YmdHis');
        $telaahFileExtension = $telaahFile->getClientOriginalExtension();
        $telaahFileName = $telaahFileName.'.'.$telaahFileExtension;

        $lampiranFile = $request->lampiran;
        $lampiranFileName = 'dokumen_'. date('YmdHis');
        $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();
        $lampiranFileName = $lampiranFileName.'.'.$lampiranFileExtension;

        # set array data
        $data = [
            'kategori_id' => $request->kategori_id,
            'jenis' => $request->jenis,
            'nomor' => $request->nomor,
            'unit_id' => $request->unit_id,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'perihal' => $request->perihal,
            'ttd' => $request->ttd,
            'disposisi' => $request->disposisi,
            'telaah' => $telaahFileName,
            'disposisi_telaah' => $request->disposisi_telaah,
            'lampiran' => $lampiranFileName
        ];

        $uploadTelaahFile = $this
            ->lampiranFileServe
            ->uploadLampiranFile($telaahFile, $telaahFileName);

        $uploadLampiranFile = $this
            ->lampiranFileServe
            ->uploadLampiranFile($lampiranFile, $lampiranFileName);

        $storeSuratMasuk = SuratMasuk::create($data);

        return redirect('/surat-masuk')
        ->with([
            'status' => 'success',
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
        $role = Auth::guard('pengguna')->User()->role;
        $unit_id = Auth::guard('pengguna')->User()->unit_id;
        $checkSuratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk = $checkSuratMasuk;

        $unit = unit::orderBy('nama', 'asc')
            ->where(function($q) use($role, $unit_id){
                if($role == 'Staf'){
                    $q->where('id', $unit_id);
                }
            })
            ->get();
        $kategori = kategori::orderBy('jenis', 'asc')
            ->orderBy('nama', 'desc')
            ->get();
        $tahap = tahap::orderBy('jenis', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view('surat_masuk.form_edit', compact('suratMasuk', 'unit', 'kategori', 'tahap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratMasukRequest $suratMasukRequest, $id)
    {
        # set variable
        $nomor = $suratMasukRequest->nomor;
        $unitID = $suratMasukRequest->unit_id;
        $kategoriID = $suratMasukRequest->kategori_id;
        $perihal = $suratMasukRequest->perihal;
        $tanggalTerima = $suratMasukRequest->tanggal_terima;
        $lampiranFile = $suratMasukRequest->lampiran;

        if (!empty($lampiranFile)) {
            $lampiranFileName = $lampiranFile->getClientOriginalName();
            $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();

            $checkOldLampiranFile = SuratMasuk::find($id);
            $oldLampiranFile = $checkOldLampiranFile->lampiran;

            if(!empty($oldLampiranFile)){
                $deleteLampiranFile = Storage::disk('uploads')
                    ->delete('documents/surat-masuk/'.$oldLampiranFile);

                $uploadLampiranFile = $this
                    ->lampiranFileServe
                    ->uploadLampiranFile($lampiranFile, $lampiranFileName);
            }else{
                $uploadLampiranFile = $this
                    ->lampiranFileServe
                    ->uploadLampiranFile($lampiranFile, $lampiranFileName);
            }

            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'perihal' => $perihal,
                'tanggal_terima' => $tanggalTerima,
                'lampiran' => $lampiranFileName
            ];

            $storeSuratMasuk = SuratMasuk::where('id', $id)
                ->update($data);
        }else{
            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'asal' => $asal,
                'perihal' => $perihal,
                'tanggal_terima' => $tanggalTerima
            ];

            $storeSuratMasuk = SuratMasuk::where('id', $id)
                ->update($data);
        }

        return redirect('/surat-masuk')
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
        $findSuratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk = SuratMasuk::find($id);
        $lampiranFileName = $suratMasuk->lampiran;

        # check lampiran file if exist
        if (!empty($lampiranFileName)) {
            $deleteLampiranFile = $this
                ->lampiranFileServe
                ->deleteLampiranFile($lampiranFileName);
        }

        $deleteSuratMasuk = SuratMasuk::destroy($id);

        return redirect('/surat-masuk')
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
    public function sendEmail($id)
    {
        $findSuratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk = SuratMasuk::with('kategori')
            ->find($id);

        $kategoriEmail   = $suratMasuk->kategori->email;
        $kategoriName    = $suratMasuk->kategori->nama;

        try {
            Mail::to($kategoriEmail)
                ->send(new SuratMasukMail($kategoriName));

            $data = [
                'status_email' => 'Terkirim'
            ];

            $updateSuratMasuk = SuratMasuk::where('id', $id)
                ->update($data);

            return redirect('/surat-masuk')
                ->with([
                    'status' => 'success',
                    'notification' => 'Email berhasil terkirim!'
                ]);
        } catch (\Exception $e) {
            return redirect('/surat-masuk')
                ->with([
                    'status' => 'warning',
                    'notification' => 'Email gagal terkirim!'
                ]);
        }
    }
}
