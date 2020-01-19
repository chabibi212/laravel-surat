@extends('layouts.main')

@section('title')
Dashboard &raquo; Surat Masuk | Aplikasi Manajemen Surat
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Dokumen
                </h3>
                <hr />
                @if(session('notification'))
                    <div
                        class="alert alert-{{ session('status') }} alert-dismissible fade show"
                        role="alert"
                    >
                        {{ session('notification') }}
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div>
                    <form class="form-inline">
                    <div class="form-group mb-2">
                        <select
                            name="filter_unit"
                            id="filter_unit"
                            class="form-control"
                            style="width: 200px"
                        >
                            <option value="">--- Filter Unit ---</option>
                            @foreach($unit as $item)
                                <option value="{{ $item->id }}" {{ $filter_unit == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <select
                            name="filter_kategori"
                            id="filter_kategori"
                            class="form-control"
                            style="width: 300px"
                        >
                            <option value="">--- Filter Kategori ---</option>
                            @foreach($jenis as $jenis_item)
                                <optgroup label="{{ $jenis_item }}">
                                    @foreach($kategori as $item)
                                    @if($item->jenis == $jenis_item)
                                        <option value="{{ $item->id }}" {{ $filter_kategori == $item->id ? 'selected' : '' }}>{{ $item->jenis .'-'. $item->nama }}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <select
                            name="filter_year"
                            id="filter_year"
                            class="form-control"
                            style="width: 100px"
                        >
                            <option value="">--- Filter Year ---</option>
                            @for($y=2019;$y<=date('Y');$y++)
                                <option value="{{ $y }}" {{ $filter_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" name="filter_text" class="form-control" placeholder="Masukkan kata kunci" style="width: 250px" value="{{ $filter_text }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                    </form>
                </div>
                <hr/>
                <div>
                    <a href="{{ url('/surat-masuk/form-tambah') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Dokumen
                    </a>
                </div>
                <hr/>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Jenis</th>
                                <th scope="col">Perangkat Daerah</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Nomor</th>
                                <th scope="col">Tanggal Diterima</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Yang Bertandatangan</th>
                                <th scope="col">Disposisi/ Arahan/ Petunjuk</th>
                                <th scope="col">Telaah Staf</th>
                                <th scope="col">Disposisi/ Arahan/ Petunjuk atas Telaah Staf</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($suratMasuk) == 0)
                                <tr>
                                    <td colspan="8" align="center"><b>Tidak ada data untuk ditampilkan</b></td>
                                </tr>
                            @endif
                            @foreach($suratMasuk as $item)
                                <tr>
                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ @$item->unit->nama }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_surat)) }}</td>
                                    <td>{{ @$item->nomor }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_terima)) }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>{{ $item->ttd }}</td>
                                    <td>{{ $item->disposisi }}</td>
                                    <td>
                                        <a
                                            href="{{ url('uploads/documents/surat-masuk/'. $item->telaah) }}"
                                            class="btn btn-sm btn-primary text-white"
                                            target="_blank"
                                        >
                                            <i class="fa fa-file"></i> Lihat
                                        </a>
                                    </td>
                                    <td>{{ $item->disposisi_telaah }}</td>
                                    <td>
                                        <a
                                            href="{{ url('uploads/documents/surat-masuk/'. $item->lampiran) }}"
                                            class="btn btn-sm btn-primary text-white"
                                            target="_blank"
                                        >
                                            <i class="fa fa-file"></i> Lihat
                                        </a>
                                        <!--<a
                                            href="{{ url('/surat-masuk/form-ubah/'. $item->id) }}"
                                            class="btn btn-sm btn-warning text-white"
                                        >
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>-->
                                        <a
                                            href="{{ url('/surat-masuk/hapus/'. $item->id) }}"
                                            class="btn btn-sm btn-danger"
                                        >
                                            <i class="fa fa-times"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $suratMasuk->links() }}
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection