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
                <p>
                    <a href="{{ url('/surat-masuk/form-tambah') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Dokumen
                    </a>
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Unit Asal</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Tanggal Diterima</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tahap</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratMasuk as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ @$item->unit->nama }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_surat)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_terima)) }}</td>
                                    <td>{{ @$item->kategori->nama }}</td>
                                    <td>{{ @$item->tahap->nama }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>
                                        <a
                                            href="{{ url('uploads/documents/surat-masuk/'. $item->lampiran) }}"
                                            class="btn btn-sm btn-primary text-white"
                                            target="_blank"
                                        >
                                            <i class="fa fa-file"></i> Lihat
                                        </a>
                                        <a
                                            href="{{ url('/surat-masuk/form-ubah/'. $item->id) }}"
                                            class="btn btn-sm btn-warning text-white"
                                        >
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>
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