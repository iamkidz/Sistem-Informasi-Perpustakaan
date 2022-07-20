<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['id'];
    protected $table = 'buku';
    public $timestamps = false;

    public function peminjam() {
        return $this->belongsToMany(Peminjaman::class, 'id_buku');
    }
}
