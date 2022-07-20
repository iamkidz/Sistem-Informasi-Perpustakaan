@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="mb-3 col-md-6">
                <h5 style="font-weight: 500;font-size:1.125rem">Data Report Buku</h5>
            </div>
            <div class="mb-3 text-right col-md-6">
                <a type="button" class="btn btn-warning" href="{{ url('report/buku_semua') }}">Report Semua</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered w-100">
                    <thead class="text-center">
                        <tr>
                            <th>No Klasifikasi</th>
                            <th>Judul Buku</th>
                            <th>Jenis</th>
                            <th>Mapel</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($buku as $item)
                            <tr>
                                <td>{{ $item->no_klasifikasi }}</td>
                                <td>{{ $item->judul_buku }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->mapel }}</td>
                                <td>{{ $item->nama_pengarang }}</td>
                                <td>{{ $item->penerbit }}</td>
                                <td>{{ $item->tahun_terbit }}</td>
                                <td>@currency($item->harga)</td>
                                <td>{{ $item->jumlah_buku }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('report/per_buku/' . $item->id) }}" id="cetak">
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endsection
