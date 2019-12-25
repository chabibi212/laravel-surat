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
                                <th scope="col">Asal</th>
                                <th scope="col">Tanggal Diterima</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tahap</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratMasuk as $item)
                                <tr>
                                    <td>{{ $item->nomor }}</td>
                                    <td>{{ $item->asal }}</td>
                                    <td>{{ $item->tanggal_terima->formatLocalized('%d %B %Y') }}</td>
                                    <td>{{ $item->tanggal_surat->formatLocalized('%d %B %Y') }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>{{ $item->kategori ->nama }}</td>
                                    <td>{{ $item->tahap ->nama }}</td>
                                   
                                    <td>
                                        @if($item->status == 'Valid')
                                            <span
                                                class="badge badge-success"
                                            >
                                                {{ $item->Valid}}
                                            </span>
                                        @else
                                            <span
                                                class="badge badge-warning text-white"
                                            >
                                                {{ $item->status == 'Invalid' }}
                                            </span>
                                        @endif
                                    </td>
                                        <a
                                            href="/surat-masuk/form-ubah/{{ $item->id }}"
                                            class="btn btn-sm btn-warning text-white"
                                        >
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="/surat-masuk/hapus/{{ $item->id }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();"
                                        >
                                            <i class="fa fa-times"></i> Hapus
                                        </a>
                                        <form
                                            id="delete-form"
                                            action="/surat-masuk/hapus/{{ $item->id }}"
                                            method="post"
                                            style="display: none;"
                                        >
                                            <input
                                                type="hidden"
                                                name="_token"
                                                value="{{ csrf_token() }}"
                                            />
                                            <input
                                                type="hidden"
                                                name="_method"
                                                value="delete"
                                            />
                                        </form>
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
