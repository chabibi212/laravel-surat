@extends('layouts.main')

@section('title')
Dashboard &raquo; tahap | Aplikasi Manajemen Surat
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Ubah Tahap
                </h3>
                <hr />
                <form action="{{ url('/tahap/ubah/'. $tahap->id) }}" method="post">
                    <input
                        type="hidden"
                        name="_token"
                        value="{{ csrf_token()}}"
                    />
                    <input
                        type="hidden"
                        name="_method"
                        value="put"
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
                                    value="{{ $tahap->nama }}"
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
                                    <option value="RKT" {{ $tahap->jenis == 'RKT' ? 'selected' : '' }}>RKT</option>
                                    <option value="RKPD-RENJA"{{ $tahap->jenis == 'RKPD-RENJA' ? 'selected' : '' }}>RKPD-RENJA</option>
                                    <option value="RKPD"{{ $tahap->jenis == 'RKPD' ? 'selected' : '' }}>RKPD</option>
                                    <option value="RENJA"{{ $tahap->jenis == 'RENJA' ? 'selected' : '' }}>RENJA</option>
                                    <option value="LAMPIRAN SE"{{ $tahap->jenis == 'LAMPIRAN SE' ? 'selected' : '' }}>LAMPIRAN SE</option>
                                    <option value="RKT LAKIP"{{ $tahap->jenis == 'RKT LAKIP' ? 'selected' : '' }}>RKT LAKIP</option>
                                    <option value="RENJA KABKOTA"{{ $tahap->jenis == 'RENJA KABKOTA' ? 'selected' : '' }}>RENJA KABKOTA</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
