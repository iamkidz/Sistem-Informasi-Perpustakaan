@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
@endsection

@section('content')
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

    function hitungLamaPinjam($awal, $akhir)
    {
        $awal = new DateTime($awal);
        $akhir = new DateTime($akhir);

        $abs_diff = $akhir->diff($awal)->format('%a Hari');

        return $abs_diff;
    }

    @endphp

    <div class="container">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#buku">Buku</a>
                    </li>
                    @if (Auth::user()->level != 3)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#peminjam">Peminjam</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="mt-1 card-body tab-content">
                <div class="tab-pane active" id="buku">
                    <div class="mb-3">
                        <label for="no_klasifikasi" class="form-label">No Klasifikasi</label>
                        <input disabled type="text" value="{{ $buku->no_klasifikasi }}" class="form-control"
                            id="no_klasifikasi" name="no_klasifikasi">
                    </div>
                    <div class="mb-3">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input disabled type="text" value="{{ $buku->judul_buku }}" class="form-control" id="judul_buku"
                            name="judul_buku">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select disabled type="text" value="{{ $buku->jenis }}" class="form-control" id="jenis"
                            name="jenis">
                            <option value="Pengayaan" {{ $buku->jenis == 'Pengayaan' ? 'selected' : '' }}>Pengayaan
                            </option>
                            <option value="Referensi" {{ $buku->jenis == 'Referensi' ? 'selected' : '' }}>Referensi
                            </option>
                            <option value="Paeda" {{ $buku->jenis == 'Paeda' ? 'selected' : '' }}>Paeda</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mapel</label>
                        <select disabled type="text" value="{{ $buku->mapel }}" class="form-control" id="mapel"
                            name="mapel">
                            <option value="BI" {{ $buku->mapel == 'BI' ? 'selected' : '' }}>BI</option>
                            <option value="IPA" {{ $buku->mapel == 'IPA' ? 'selected' : '' }}>IPA</option>
                            <option value="IPS" {{ $buku->mapel == 'IPS' ? 'selected' : '' }}>IPS</option>
                            <option value="KMS BI" {{ $buku->mapel == 'KMS BI' ? 'selected' : '' }}>KMS BI</option>
                            <option value="KMS INGG" {{ $buku->mapel == 'KMS INGG' ? 'selected' : '' }}>KMS INGG</option>
                            <option value="MAT" {{ $buku->mapel == 'MAT' ? 'selected' : '' }}>MAT</option>
                            <option value="PAEDA" {{ $buku->mapel == 'PAEDA' ? 'selected' : '' }}>PAEDA</option>
                            <option value="PAI" {{ $buku->mapel == 'PAI' ? 'selected' : '' }}>PAI</option>
                            <option value="PENJAS" {{ $buku->mapel == 'PENJAS' ? 'selected' : '' }}>PENJAS</option>
                            <option value="PD" {{ $buku->mapel == 'PD' ? 'selected' : '' }}>PD</option>
                            <option value="PKN" {{ $buku->mapel == 'PKN' ? 'selected' : '' }}>PKN</option>
                            <option value="SBK" {{ $buku->mapel == 'SBK' ? 'selected' : '' }}>SBK</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pengarang" class="form-label">Nama Pengarang</label>
                        <input disabled type="text" value="{{ $buku->nama_pengarang }}" class="form-control"
                            id="nama_pengarang" name="nama_pengarang">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Nama Penerbit</label>
                        <input disabled type="text" value="{{ $buku->penerbit }}" class="form-control" id="penerbit"
                            name="penerbit">
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input disabled type="number" value="{{ $buku->tahun_terbit }}" class="form-control"
                            id="tahun_terbit" name="tahun_terbit">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input disabled type="number" value="{{ $buku->harga }}" class="form-control" id="harga"
                            name="harga">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                        <input disabled type="number" value="{{ $buku->jumlah_buku }}" class="form-control"
                            id="jumlah_buku" name="jumlah_buku">
                    </div>
                    <div class="mb-3">
                        <label for="staf_penerima" class="form-label">Staf Penerima</label>
                        <input disabled type="text" value="{{ $buku->staf_penerima }}" class="form-control"
                            id="staf_penerima" name="staf_penerima">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input disabled type="text" value="{{ $buku->keterangan }}" class="form-control"
                            id="keterangan" name="keterangan">
                    </div>
                </div>
                @if (Auth::user()->level != 3)
                    <div class="tab-pane" id="peminjam">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered w-100">
                                <thead class="text-center">
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
                                    @foreach ($pinjam as $item)
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
                                                <td>{{ hitungLamaPinjam($item->tanggal_pinjam, $item->tanggal_dikembalikan) }}
                                                </td>
                                            @endif
                                            <td>{{ $item->status_pinjam }}</td>
                                            <td>{{ $item->status_persetujuan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <a href="{{ url('buku') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endsection
