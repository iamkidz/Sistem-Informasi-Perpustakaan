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

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
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
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            font-weight: bold;
            color: black;
        }

    </style>
    <title>Report Data Hilang</title>
</head>

<body>
    <header style="text-align: center;margin-top:10px;">
        <h4 style="font-size: 2em;  margin-bottom: 0px;">Sistem Informasi Perpustakaan Dinas</h4>
        <p>Jln. kusuma bangsa No. 101, GKB, Sumatra, Email: admin@gmail.com, HP: 08123455678</p>
        <hr style="color:black;size:3px;margin-bottom:30px">
    </header>
    <table>
        <tr>
            <th colspan="2">Detail Data Hilang</th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ tgl_indo($hilang->tanggal) }}</td>
        </tr>
        <tr>
            <th>Judul Buku</th>
            <td>{{ $hilang->buku->judul_buku }}</td>
        </tr>
        <tr>
            <th>Nama Pengarang</th>
            <td>{{ $hilang->buku->nama_pengarang }}</td>
        </tr>
        <tr>
            <th>Nama Penerbit</th>
            <td>{{ $hilang->buku->penerbit }}</td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $hilang->buku->tahun_terbit }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>@currency($hilang->buku->harga)</td>
        </tr>
        <tr>
            <th>Jenis</th>
            <td>{{ $hilang->buku->jenis }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $hilang->keterangan }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $hilang->jumlah }}</td>
        </tr>
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
