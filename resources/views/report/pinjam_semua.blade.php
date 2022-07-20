<!DOCTYPE html>
<html lang="en">
@php
function tgl_indo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . '-' . $pecahkan[1] . '-' . $pecahkan[0];
}

function hitungLamaPinjam($awal, $akhir)
{
    $awal = new DateTime($awal);
    $akhir = new DateTime($akhir);

    $abs_diff = $akhir->diff($awal)->format('%a Hari');

    return $abs_diff;
}
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 4em;
        }

        table td,
        table th {
            border: 1px solid black;
            padding: 2px;
            text-align: center;
        }

        table th {
            text-align: center;
            font-weight: bold;
            color: black;
        }

    </style>
    <title>Report Peminjaman</title>
</head>

<body>
    <header style="text-align: center;margin-top:10px;">
        <h4 style="font-size: 2em;  margin-bottom: 0px;">Sistem Informasi Perpustakaan Dinas</h4>
        <p>Jln. kusuma bangsa No. 101, GKB, Sumatra, Email: admin@gmail.com, HP: 08123455678</p>
        <hr style="color:black;size:3px;margin-bottom:20px">
    </header>

    <div style="text-align: center;font-weight: bold;">
        <h2>Laporan Data Peminjaman {{ $jenis }}</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Lama Pinjam</th>
                <th>Status Peminjaman</th>
                <th>Status Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pinjam as $item)
                <tr>
                    <td>{{ $item->buku->judul_buku }}</td>
                    <td>{{ $item->user->nama }}</td>
                    <td>{{ tgl_indo($item->tanggal_pinjam) }}</td>
                    <td>{{ tgl_indo($item->tanggal_kembali) }}</td>
                    @if (empty($item->tanggal_dikembalikan))
                        <td></td>
                        <td></td>
                    @else
                        <td>{{ tgl_indo($item->tanggal_dikembalikan) }}</td>
                        <td>{{ hitungLamaPinjam($item->tanggal_pinjam, $item->tanggal_dikembalikan) }}</td>
                    @endif
                    <td>{{ $item->status_pinjam }}</td>
                    <td>{{ $item->status_persetujuan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        <div style="float:right;text-align: center">
            <span>Gresik, {{ date('d-m-Y') }}</span><br />
            <p style="margin-bottom: 15px;margin-top:15px"><small>ttd</small></p>
            <span style="font-weight: bold">Nama Petugas</span><br />
            <span>Nip. 1111</span>
        </div>
    </div>
</body>

</html>
