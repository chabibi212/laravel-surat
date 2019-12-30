@extends('layouts.main')

@section('title')
Dashboard | Aplikasi Manajemen Surat
@endsection

@section('content')
<style type="text/css">
    /* Remove default bullets */
    ul, #myUL {
      list-style-type: none;
    }

    /* Remove margins and padding from the parent ul */
    #myUL {
      margin: 0;
      padding: 0;
    }

    /* Style the caret/arrow */
    .caret {
      cursor: pointer;
      user-select: none; /* Prevent text selection */
    }

    /* Create the caret/arrow with a unicode, and style it */
    .caret::before {
      content: "\25B6";
      color: black;
      display: inline-block;
      margin-right: 1px;
    }

    .bullets::before {
      content: "\2022";
      color: black;
      display: inline-block;
      margin-right: 5px;
    }

    /* Rotate the caret/arrow icon when clicked on (using JavaScript) */
    .caret-down::before {
      transform: rotate(90deg);
    }

    /* Hide the nested list */
    .nested {
      display: none;
    }

    /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
    .active {
      display: block;
    }
</style>
<div class="container">
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                Halaman Awal
            </h3>
            <hr />
            <div class="row">
                <div class="col-md-4" style="border-right: 1px solid black;">
                    <ul id="myUL">
                        <li><span class="caret">Perangkat Daerah</span>
                            <ul class="nested">
                                @foreach($unit as $item)
                                    <li><span class="caret">{{ $item->nama }}</span>
                                        <ul class="nested">
                                            @foreach($kategori as $datum)
                                                @if($datum->jenis == 'Perangkat Daerah')
                                                <a href="{{ url('?filter_unit='. $item->id .'&filter_kategori='. $datum->id) }}">
                                                    <li><span class="bullets">{{ $datum->nama }}</span></li>
                                                </a>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><span class="caret">Surat Masuk</span>
                            <ul class="nested">
                                @foreach($kategori as $datum)
                                    @if($datum->jenis == 'Surat Masuk')
                                    <a href="{{ url('?filter_kategori='. $datum->id) }}">
                                        <li><span class="bullets">{{ $datum->nama }}</span></li>
                                    </a>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><span class="caret">Telaah Staf</span>
                            <ul class="nested">
                                @foreach($kategori as $datum)
                                    @if($datum->jenis == 'Telaah Staf')
                                    <a href="{{ url('?filter_kategori='. $datum->id) }}">
                                        <li><span class="bullets">{{ $datum->nama }}</span></li>
                                    </a>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><span class="caret">Petunjuk / Arahan</span>
                            <ul class="nested">
                                @foreach($kategori as $datum)
                                    @if($datum->jenis == 'Petunjuk / Arahan')
                                    <a href="{{ url('?filter_kategori='. $datum->id) }}">
                                        <li><span class="bullets">{{ $datum->nama }}</span></li>
                                    </a>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><span class="caret">Surat Keluar</span>
                            <ul class="nested">
                                @foreach($kategori as $datum)
                                    @if($datum->jenis == 'Surat Keluar')
                                    <a href="{{ url('?filter_kategori='. $datum->id) }}">
                                        <li><span class="bullets">{{ $datum->nama }}</span></li>
                                    </a>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <a href="{{ url('agenda.xlsx') }}">
                        <li><span class="bullets">Agenda Kerja</span></li>
                        </a>
                    </ul>
                </div>
                <div class="col-md-8">
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

<script type="text/javascript">
    var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>
@endsection
