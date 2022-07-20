<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_buku')->references('id')->on('buku')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_user')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal_pinjam')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->date('tanggal_dikembalikan')->nullable();
            $table->enum('status_pinjam', ['Belum Dikembalikan', 'Sudah Dikembalikan'])->default('Belum Dikembalikan');
            $table->enum('status_persetujuan', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'])->default('Menunggu Persetujuan');
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
        Schema::dropIfExists('peminjaman');
    }
}
