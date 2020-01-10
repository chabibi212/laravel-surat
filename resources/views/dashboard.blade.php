@extends('layouts.main')

@section('title')
Dashboard | Aplikasi Manajemen Surat
@endsection

@section('content')
<?php
$months = [
    ['01', 'Januari'],
    ['02', 'Februari'],
    ['03', 'Maret'],
    ['04', 'April'],
    ['05', 'Mei'],
    ['06', 'Juni'],
    ['07', 'Juli'],
    ['08', 'Agustus'],
    ['09', 'September'],
    ['10', 'Oktober'],
    ['11', 'November'],
    ['12', 'Desember'],
];
?>
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
            <h3 class="card-title" style="text-align: center;">
                e-adarangga
            </h3>
            <hr />
            <div class="row">
                <div class="col-md-12" style="padding-left: 30px; text-align: center;">
                    Hai {{ Auth::guard('pengguna')->User()->nama }}, selamat datang di halaman awal Elektronik Arsip Dokumen Perencanaan dan Penganggaran (e-adarangga).<br/>
                    Anda dapat menggunakan menu diatas, ikon dashboard atau fitur pencarian dibawah ini.
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12" style="padding-left: 30px; text-align: center;">
                    <form class="form-inline" method="GET" action="{{ url('surat-masuk') }}">
                        <div class="form-group mb-2">
                            <input type="text" name="filter_text" class="form-control" placeholder="Masukkan kata kunci pencarian dokumen" style="width: 400px">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                    </form>
                </div>
            </div>
            <hr/>
            <div class="row" id="icon_container">
                <div class="col-sm-4 col-md-4 icon_dashboard" data-id="dokumen" style="cursor: pointer;">
                    <div class="thumbnail" style="text-align: center;">
                        <img src="{{ url('/assets/img/doc.png') }}" alt="Dokumen">
                            <div class="caption">
                            <h4>Dokumen</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 icon_dashboard" data-id="persuratan_i" style="cursor: pointer;">
                    <div class="thumbnail" style="text-align: center;">
                        <img src="{{ url('/assets/img/mail1.png') }}" alt="Persuratan I">
                            <div class="caption">
                            <h4>Persuratan I</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 icon_dashboard" data-id="persuratan_ii" style="cursor: pointer;">
                    <div class="thumbnail" style="text-align: center;">
                        <img src="{{ url('/assets/img/mail2.png') }}" alt="Persuratan II">
                            <div class="caption">
                            <h4>Persuratan II</h4>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row" id="list_container">
                @foreach($jenis as $jenis_item)
                <div class="col-md-12 listcomponent" id="listcomponent_{{ strtolower(str_replace(' ', '_', $jenis_item)) }}">
                    <div class="list-group list-group-root well">
                    @php $i = 0; @endphp
                    @foreach($kategori as $kategori_item)
                        @if($jenis_item == $kategori_item->jenis)
                        @if($kategori_item->nama == 'DOKUMEN RPJMD')
                        <a
                            href="{{ url('uploads/documents/surat-masuk/rpjmd_jatim_2019_2024_official.pdf') }}"
                            class="btn btn-sm btn-primary text-white"
                            target="_blank"
                        >
                        @elseif($kategori_item->nama == 'DOKUMEN RKPD')
                        <a
                            href="{{ url('uploads/documents/surat-masuk/rkpd_jatim_2020.pdf') }}"
                            class="btn btn-sm btn-primary text-white"
                            target="_blank"
                        >
                        @else
                        @php $i++; @endphp
                        <a href="#item-{{ $i }}" class="list-group-item" data-toggle="collapse">
                            <i class="fa fa-chevron-right"></i> {{ $kategori_item->nama }}
                        </a>
                        <div class="list-group collapse" id="item-{{ $i }}">
                            @if($jenis_item == 'Dokumen')
                            @php $j = 0; @endphp
                            @foreach($unit as $unit_item)
                                @php $j++; @endphp
                            <a href="#item-{{ $i .'-'. $j }}" class="list-group-item" data-toggle="collapse">
                                <i class="fa fa-chevron-right"></i> {{ $unit_item->nama }}
                            </a>
                            <div class="list-group collapse" id="item-{{ $i .'-'. $j }}">
                                @for($y=2019;$y<=date('Y');$y++)
                                    <a href="{{ url('surat-masuk?filter_unit='. $unit_item->id .'&filter_kategori='. $kategori_item->id .'&filter_year='. $y) }}" class="list-group-item">
                                        <i class="fa fa-minus"></i>{{ $y }}
                                    </a>
                                @endfor
                            </div>
                            @endforeach
                            @else

                            @php $j = 0; @endphp
                            @for($y=2019;$y<=date('Y');$y++)
                                @php $j++; @endphp
                            <a href="#item-{{ $i .'-'. $j }}" class="list-group-item" data-toggle="collapse">
                                <i class="fa fa-chevron-right"></i> {{ $y }}
                            </a>
                            <div class="list-group collapse" id="item-{{ $i .'-'. $j }}">
                                @foreach($months as $month)
                                    <a href="{{ url('surat-masuk?filter_month='. $month[0] .'&filter_kategori='. $kategori_item->id .'&filter_year='. $y) }}" class="list-group-item">
                                        <i class="fa fa-minus"></i>{{ $month[1] }}
                                    </a>
                                @endforeach
                            </div>
                            @endfor

                            @endif
                        </div>
                        @endif
                        @endif
                    @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
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
    $("#list_container").hide();
    $('.list-group-item').on('click', function() {
    $('.fa', this)
        .toggleClass('fa-chevron-right')
        .toggleClass('fa-chevron-down');
    });

    $(".icon_dashboard").click(function(){
        var me = $(this);
        $("#list_container").show();
        $("#list_container .listcomponent").hide();
        $("#listcomponent_"+ me.data('id')).show();
    });
});
</script>
@endsection
