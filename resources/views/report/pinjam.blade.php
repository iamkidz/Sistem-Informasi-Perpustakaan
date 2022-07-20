@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/bootstrap-datepicker3.standalone.min.css') }}" />
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
        <div class="row justify-content-between">
            <div class="mb-3 col-md-6">
                <h5 style="font-weight: 500;font-size:1.125rem">Data Peminjaman</h5>
            </div>
            <div class="mb-3 text-right col-md-6">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalBulanan">Report
                    Bulanan</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTahunan">Report
                    Tahunan</button>
                <a type="button" class="btn btn-warning" href="{{ url('report/pinjam_semua') }}">Report Semua</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
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
                            <th>Aksi</th>
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
                                    <td>{{ hitungLamaPinjam($item->tanggal_pinjam, $item->tanggal_dikembalikan) }}</td>
                                @endif
                                <td>{{ $item->status_pinjam }}</td>
                                <td>{{ $item->status_persetujuan }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('report/per_pinjam/' . $item->id) }}" id="cetak">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTahunan" tabindex="-1" aria-labelledby="modalTahunanLabel" aria-hidden="true">
        <div class="modal-dialog">

            <form action="{{ url('report/pinjam_tahunan') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTahunanLabel">Report Tahunan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Pilih Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalBulanan" tabindex="-1" aria-labelledby="modalBulananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('report/pinjam_bulanan') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBulananLabel">Report Bulanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Pilih Bulan</label>
                            <input type="text" class="form-control" id="bulan" name="bulan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.id.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });

        $("#tahun").datepicker({
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });

        $("#bulan").datepicker({
            format: "mm-yyyy",
            startView: "months",
            minViewMode: "months"
        });
    </script>
@endsection
