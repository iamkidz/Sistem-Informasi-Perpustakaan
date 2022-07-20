<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataHilangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_hilang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('id_buku')->references('id')->on('buku')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('jenis', ['hilang', 'rusak']);
            $table->string('keterangan')->nullable();
            $table->integer('jumlah')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_hilang');
    }
}
