<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('jenis')->nullable();
            $table->string('mapel')->nullable();
            $table->string('no_klasifikasi')->nullable();
            $table->string('judul_buku')->nullable();
            $table->string('nama_pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('tahun_terbit', 5)->nullable();
            $table->string('staf_penerima')->nullable();
            $table->decimal('harga',10,0)->nullable();
            $table->integer('jumlah_buku');
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
