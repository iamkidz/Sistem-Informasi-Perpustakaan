@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/selectpicker/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/bootstrap-datepicker.min.css') }}" />
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
    @endphp

    <div class="container">
        <div class="row justify-content-between">
            <div class="mb-3 col-md-6">
                <h5 style="font-weight: 500;font-size:1.125rem">Data Hilang</h5>
            </div>
            <div class="mb-3 text-right col-md-6">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah
                    Data</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered w-100">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ tgl_indo($item->tanggal) }}</td>
                                <td>{{ $item->buku->judul_buku }}</td>
                                <td>{{ $item->buku->nama_pengarang }}</td>
                                <td>{{ $item->buku->penerbit }}</td>
                                <td>{{ $item->buku->tahun_terbit }}</td>
                                <td>@currency($item->buku->harga)</td>
                                <td>{{ ucfirst($item->jenis) }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('data-hilang/' . $item->id . '/edit') }}" id="edit">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ url('data-hilang/' . $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Apakah kamu yakin?')" type="submit"
                                                id="delete">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('data-hilang') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" class="form-control datepicker" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="id_buku" class="form-label">Judul Buku</label>
                            <select type="text" class="form-control selectpicker" id="id_buku" name="id_buku"
                                data-live-search="true">
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul_buku }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select type="number" class="form-control" id="jenis" name="jenis">
                                <option value="hilang">Hilang</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/selectpicker/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendor/selectpicker/defaults-id_ID.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.id.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });

        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endsection
