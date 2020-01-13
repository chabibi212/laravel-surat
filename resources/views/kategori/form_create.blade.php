@extends('layouts.main')

@section('title')
Dashboard &raquo; kategori | Aplikasi Manajemen Surat
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Tambah kategori
                </h3>
                <hr />
                <form action="{{ url('/kategori/simpan') }}" method="post">
                    <input
                        type="hidden"
                        name="_token"
                        value="{{ csrf_token()}}"
                    />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="nama">
                                    Nama *
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                    value="{{ old('nama') }}"
                                />
                                @if($errors->has('nama'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="jenis">
                                    Jenis
                                </label>
                                <select name="jenis" class="form-control">
                                    <option value="Dokumen">Dokumen</option>
                                    <option value="Surat Rangga">Surat Rangga</option>
                                    <option value="Surat Harian">Surat Harian</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <p>
                        <code>
                            Label bertanda (*) wajib diisi atau dipilih
                        </code>
                    </p>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
