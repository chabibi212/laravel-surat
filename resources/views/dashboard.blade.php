@extends('layouts.main')

@section('title')
Dashboard | Aplikasi Manajemen Surat
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Halaman Awal
                </h3>
                <hr />
                <form class="form-inline">
                    <div class="form-group mb-2">
                        <select
                            name="filter_jenis"
                            id="filter_jenis"
                            class="form-control"
                            style="width: 200px"
                        >
                            <option value="">--- Filter Jenis ---</option>
                            <option value="Perangkat Daerah" {{ $filter_jenis == 'Perangkat Daerah' ? 'selected' : '' }}>Perangkat Daerah</option>
                            <option value="Surat Masuk" {{ $filter_jenis == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="Telaah Staf" {{ $filter_jenis == 'Telaah Staf' ? 'selected' : '' }}>Telaah Staf</option>
                            <option value="Petunjuk / Arahan" {{ $filter_jenis == 'Petunjuk / Arahan' ? 'selected' : '' }}>Petunjuk / Arahan</option>
                            <option value="Surat Keluar" {{ $filter_jenis == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                            <option value="Agenda Kerja" {{ $filter_jenis == 'Agenda Kerja' ? 'selected' : '' }}>Agenda Kerja</option>
                        </select>
                    </div>
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
                            style="width: 200px"
                        >
                            <option value="">--- Filter Kategori ---</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}" {{ $filter_kategori == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <select
                            name="filter_tahap"
                            id="filter_tahap"
                            class="form-control"
                            style="width: 200px"
                        >
                            <option value="">--- Filter Tahap ---</option>
                            @foreach($tahap as $item)
                                <option value="{{ $item->id }}" {{ $filter_tahap == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                </form>
                <hr />
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Jenis</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tahap</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratMasuk as $item)
                                <tr>
                                    <td>{{ @$item->kategori->jenis }}</td>
                                    <td>{{ @$item->unit->nama }}</td>
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
        </div>
    </div>
</div>
@endsection
