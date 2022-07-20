<?php

namespace App\Imports;

use App\Models\Buku;
use App\Models\RiwayatStok;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class BukuImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $buku = Buku::insertGetId([
                'no_klasifikasi' => $row['no_klasifikasi'],
                'judul_buku' => $row['judul_buku'],
                'jenis' => $row['jenis'],
                'mapel' => $row['mapel'],
                'nama_pengarang' => $row['nama_pengarang'],
                'penerbit' => $row['nama_penerbit'],
                'tahun_terbit' => $row['tahun_terbit'],
                'harga' => $row['harga'],
                'jumlah_buku' => $row['jumlah_buku'],
                'staf_penerima' => $row['staf_penerima'],
                'keterangan' => $row['keterangan'],
            ]);

            RiwayatStok::create([
                'id_buku' => $buku,
                'jenis' => 'buku_baru',
                'jumlah' => $row['jumlah_buku']
            ]);
        }
    }
}
