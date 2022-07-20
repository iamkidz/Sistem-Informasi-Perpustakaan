<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_buku')->references('id')->on('buku')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('jenis', ['buku_baru', 'tambah_stok', 'hilang_rusak', 'dipinjam', 'dikembalikan']);
            $table->integer('jumlah');
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
        Schema::dropIfExists('riwayat_stok');
    }
}
