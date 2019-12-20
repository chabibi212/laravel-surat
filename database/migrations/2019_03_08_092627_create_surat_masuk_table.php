<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unit_id');
            $table->bigInteger('pengguna_id');
            $table->bigInteger('kategori_id');
            $table->string('nomor', 75);
            $table->string('asal', 75);
            $table->string('perihal', 150);
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
            $table->string('lampiran', 250)->nullable();
            $table->string('status_email', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk');
    }
}
