<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('surat_masuk');
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kategori_id');
            $table->bigInteger('unit_id');
            $table->string('jenis');
            $table->string('nomor');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima')->nullable();
            $table->string('perihal');
            $table->string('ttd')->nullable();
            $table->string('disposisi')->nullable();
            $table->string('telaah')->nullable();
            $table->string('disposisi_telaah')->nullable();
            $table->string('lampiran')->nullable();
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
