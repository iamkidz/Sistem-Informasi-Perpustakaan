<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStok extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'riwayat_stok';

    public function buku() {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
