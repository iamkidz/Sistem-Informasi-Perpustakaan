<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHilang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'data_hilang';
    public $timestamps = false;

    public function buku() {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
