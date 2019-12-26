@extends('layouts.main')

@section('title')
Dashboard &raquo; Pengguna | Aplikasi Manajemen Surat
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Pengguna
                </h3>
                <hr />
                @if(session('notification'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
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
                    <a href="{{ url('/pengguna/form-tambah') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Pengguna
                    </a>
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col" width="200">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengguna as $item)
                                <tr>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->unit_nama }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            {{ $item->role }}
                                        </span>
                                    </td>

                                    <td>
                                        <a
                                            href="{{ url('/pengguna/form-ubah/'. $item->id) }}"
                                            class="btn btn-sm btn-warning text-white"
                                        >
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="{{ url('/pengguna/hapus/{'. $item->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();"
                                        >
                                            <i class="fa fa-times"></i> Hapus
                                        </a>
                                        <form
                                            id="delete-form"
                                            action="{{ url('/pengguna/hapus/'. $item->id) }}"
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
                    {{ $pengguna->links() }}
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
