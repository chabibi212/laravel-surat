@extends('layouts.main')

@section('title')
Dashboard &raquo; Surat Masuk | Aplikasi Manajemen Surat
@endsection

@section('css')
<link
    rel="stylesheet"
    href="/assets/bootstrap-datepicker/css/bootstrap-datepicker3.css"
/>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Edit Dokumen
                </h3>
                <hr />
                <form
                    action="/surat-masuk/ubah/{{ $suratMasuk->id }}"
                    method="post"
                    enctype="multipart/form-data"
                >
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
                                <label for="nomor">
                                    Nomor Surat
                                </label>
                                <input
                                    type="text"
                                    name="nomor"
                                    class="form-control {{ $errors->has('nomor') ? ' is-invalid' : '' }}"
                                    value="{{ old('nomor') }}"
                                />
                                @if($errors->has('nomor'))
                                    <span class="invalid-feedback">
                                        <strong>
                                            {{ $errors->first('nomor') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="asal">
                                    Asal *
                                </label>
                                <input
                                    type="text"
                                    name="asal"
                                    class="form-control {{ $errors->has('asal') ? ' is-invalid' : '' }}"
                                    value="{{ old('asal') }}"
                                />
                                @if($errors->has('asal'))
                                    <span class="invalid-feedback">
                                        <strong>
                                            {{ $errors->first('asal') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="tujuan-bagian">
                                    Kategori *
                                </label>
                                <select
                                    name="ktegori_id"
                                    id="tujuan-bagian"
                                    class="form-control {{ $errors->has('kategori_id') ? ' is-invalid' : '' }}"
                                >
                                    <option value="">
                                        --- Pilih Kategori ---
                                    </option>
                                    @foreach($kategori as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('kategori_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('kategori_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="tujuan-bagian">
                                    Tahap *
                                </label>
                                <select
                                    name="tahap_id"
                                    id="tujuan-bagian"
                                    class="form-control {{ $errors->has('tahap_id') ? ' is-invalid' : '' }}"
                                >
                                    <option value="">
                                        --- Pilih tahap ---
                                    </option>
                                    @foreach($tahap as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('tahap_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tahap_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="tahap_id">
                                    Status *
                                </label>
                                <select
                                    name="tahap_id"
                                    id="tahap_id"
                                    class="form-control {{ $errors->has('kategori_id') ? ' is-invalid' : '' }}"
                                >
                                    <option value="">
                                        --- Pilih Status ---
                                    </option>
                                    <option value="Valid">
                                        Valid
                                    </option>
                                    <option value="Invalid">
                                        Invalid
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="perihal">
                                    Perihal *
                                </label>
                                <input
                                    type="text"
                                    name="perihal"
                                    class="form-control {{ $errors->has('perihal') ? ' is-invalid' : '' }}"
                                    value="{{ old('perihal') }}"
                                />
                                @if($errors->has('perihal'))
                                    <span class="invalid-feedback">
                                        <strong>
                                            {{ $errors->first('perihal') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="tanggal-surat">
                                    Tanggal Surat *
                                </label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control tanggal_surat {{ $errors->has('tanggal_surat') ? ' is-invalid' : '' }}"
                                        id="tanggal-surat"
                                        style="cursor: pointer"
                                        readonly
                                    />
                                    <input
                                        type="hidden"
                                        name="tanggal_surat"
                                        id="input-tanggal-surat"
                                    />
                                  <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                  </div>
                                    @if($errors->has('tanggal_surat'))
                                        <span class="invalid-feedback">
                                            <strong>
                                                {{ $errors->first('tanggal_surat') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="tanggal-terima">
                                    Tanggal Terima *
                                </label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control tanggal_terima {{ $errors->has('tanggal_terima') ? ' is-invalid' : '' }}"
                                        id="tanggal-terima"
                                        style="cursor: pointer"
                                        readonly
                                    />
                                    <input
                                        type="hidden"
                                        name="tanggal_terima"
                                        id="input-tanggal-terima"
                                    />
                                  <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                  </div>
                                    @if($errors->has('tanggal_terima'))
                                        <span class="invalid-feedback">
                                            <strong>
                                                {{ $errors->first('tanggal_terima') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <label for="lampiran">
                                    Lampiran
                                </label>
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="lampiran"
                                        class="{{ $errors->has('lampiran') ? ' is-invalid' : '' }}"
                                    />
                                    @if($errors->has('lampiran'))
                                        <span class="invalid-feedback">
                                            <strong>
                                                {{ $errors->first('lampiran') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <p>
                        <code>
                            Label bertanda (*) wajib diisi atau dipilih
                        </code>
                    </p>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script
    type="text/javascript"
    src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"
></script>
<script type="text/javascript">
    var tahap_id = $("#tujuan-tahap").val();
    var old_pengguna_id = {{ $suratMasuk->pengguna_id }};

    if (tahap_id != '') {
        $.ajax({
            url: '/pengguna/api/cari-pengguna-dari-tahap/'+tahap_id,
            data: 'get',
            success: function(result) {
                console.log(result);
                if(result != undefined){
                    if (result.length != 0) {
                        // empty the options on select
                        $('#tujuan-pengguna').empty();
                        $('#tujuan-pengguna').removeAttr('readonly');

                        // foreach the result assign insto variable
                        $.each(result, function(key, value) {
                            pengguna_options =
                                '<option value="'+value.id+'"'+(old_pengguna_id == value.id ? 'selected' : '')+'>'
                                    +value.nama+
                                '</option>';

                            // append into select tujuan pengguna
                            $('#tujuan-pengguna').append(pengguna_options);
                        });
                    }else{
                        $('#tujuan-pengguna').empty();

                        pengguna_options =
                            '<option value="">'+
                                '--- Belum Ada pengguna Di tahap Ini ---'+
                            '</option>';

                        $('#tujuan-pengguna').append(pengguna_options);
                        $('#tujuan-pengguna').attr('readonly', true);
                    }
                }
            }
        })
    }

    $('#tujuan-tahap').click(function(){
        // set variable
        var tahap_id = $(this).val();
        var pengguna_options = '';

        if(tahap_id != 0){
            // set ajax
            $.ajax({
                url : '/pengguna/api/cari-pengguna-dari-tahap/'+tahap_id,
                data : 'get',
                success: function(result) {
                    if(result != undefined){
                        if (result.length != 0) {
                            // empty the options on select
                            $('#tujuan-pengguna').empty();
                            $('#tujuan-pengguna').removeAttr('readonly');

                            // foreach the result assign insto variable
                            $.each(result, function(key, value) {
                                pengguna_options =
                                    '<option value="'+value.id+'">'
                                        +value.nama+
                                    '</option>';
                            });

                            // append into select tujuan pengguna
                            $('#tujuan-pengguna').append(pengguna_options);
                        }else{
                            $('#tujuan-pengguna').empty();

                            pengguna_options =
                                '<option value="">'+
                                    '--- Belum Ada pengguna Di tahap Ini ---'+
                                '</option>';

                            $('#tujuan-pengguna').append(pengguna_options);
                            $('#tujuan-pengguna').attr('readonly', true);
                        }
                    }
                },
                error: function(result) {
                    alert(result);
                }
            });
        }else{
            $('#tujuan-pengguna').empty();

            pengguna_options =
                '<option value="">'+
                    '--- Pilih tahap Terlebih Dahulu ---'+
                '</option>';

            $('#tujuan-pengguna').append(pengguna_options);
            $('#tujuan-pengguna').attr('readonly', true);
        }
    });
 $('#tanggal-surat').datepicker({
        language: 'id',
        todayHighlight: true,
        format: {
            toDisplay: function (date, format, language) {
                var day                 = date.getDate();
                var month               = date.getMonth()+1;
                var year                = date.getFullYear();
                var full_date           = day+'/'+month+'/'+year
                var real_full_date      = year+'-'+month+'-'+day;

                $('#input-tanggal-surat').val(real_full_date);

                return full_date;
            },
            toValue: function (date, format, language) {
                var day         = date.getDate();
                var month       = date.getMonth()+1;
                var year        = date.getFullYear();
                var full_date   = year+'-'+month+'-'+date

                return full_date;
            }
        }
    });
    $('#tanggal-terima').datepicker({
        language: 'id',
        todayHighlight: true,
        format: {
            toDisplay: function (date, format, language) {
                var day                 = date.getDate();
                var month               = date.getMonth()+1;
                var year                = date.getFullYear();
                var full_date           = day+'/'+month+'/'+year
                var real_full_date      = year+'-'+month+'-'+day;

                $('#input-tanggal-terima').val(real_full_date);

                return full_date;
            },
            toValue: function (date, format, language) {
                var day         = date.getDate();
                var month       = date.getMonth()+1;
                var year        = date.getFullYear();
                var full_date   = year+'-'+month+'-'+date

                return full_date;
            }
        }
    });
</script>
@endsection
