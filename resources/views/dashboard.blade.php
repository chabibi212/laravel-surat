@extends('layouts.main')

@section('title')
Dashboard | Aplikasi Manajemen Surat
@endsection

@section('content')
<style type="text/css">
.just-padding {
    padding: 15px;
}

.list-group.list-group-root {
    padding: 0;
}

.list-group.list-group-root .list-group {
    margin-bottom: 0;
}

.list-group.list-group-root > .list-group > .list-group-item {
    padding-left: 50px;
}

.list-group.list-group-root > .list-group > .list-group > .list-group-item {
    padding-left: 100px;
}

.list-group-item .fa {
    margin-right: 5px;
}
</style>
<div class="container">
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                Dokumen Mitra Perangkat Daerah
            </h3>
            <hr />
            <div class="row">
                <div class="col-md-12" style="padding-left: 30px;">
                    <form class="form-inline" method="GET" action="{{ url('surat-masuk') }}">
                        <div class="form-group mb-2">
                            <input type="text" name="filter_text" class="form-control" placeholder="Masukkan kata kunci" style="width: 400px">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="just-padding">
                        <div class="list-group list-group-root well">
                        @php $i = 0; @endphp
                        @foreach($unit as $unit_item)
                            @php $i++; @endphp
                            <a href="#item-{{ $i }}" class="list-group-item" data-toggle="collapse">
                                <i class="fa fa-chevron-right"></i> {{ $unit_item->nama }}
                            </a>
                            <div class="list-group collapse" id="item-{{ $i }}">
                                @php $j = 0; @endphp
                                @foreach($jenis as $jenis_item)
                                    @php $j++; @endphp
                                <a href="#item-{{ $i .'-'. $j }}" class="list-group-item" data-toggle="collapse">
                                    <i class="fa fa-chevron-right"></i> {{ $jenis_item }}
                                </a>
                                <div class="list-group collapse" id="item-{{ $i .'-'. $j }}">
                                    @foreach($kategori as $kategori_item)
                                        @if($kategori_item->jenis == $jenis_item)
                                        <a href="{{ url('surat-masuk?filter_unit='. $unit_item->id .'&filter_kategori='. $kategori_item->id) }}" class="list-group-item">
                                            <i class="fa fa-minus"></i>{{ $kategori_item->nama }}
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8" hidden="">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Surat</th>
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
                                        <td>{{ @$item->tanggal_surat }}</td>
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

@endsection

@section('js')
<script type="text/javascript">
$(function() {
        
  $('.list-group-item').on('click', function() {
    $('.fa', this)
      .toggleClass('fa-chevron-right')
      .toggleClass('fa-chevron-down');
  });

});
</script>
@endsection
