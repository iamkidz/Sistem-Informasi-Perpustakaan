@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/bootstrap-datepicker3.standalone.min.css') }}" />
@endsection

@section('content')
    @php
    setlocale(LC_TIME, 'id_ID');

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
                <a type="button" href="{{ url('pinjam/create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
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
                                        @if ($item->status_persetujuan == 'Menunggu Persetujuan' && Auth::user()->level == 3)
                                            <a href="{{ url('pinjam/' . $item->id . '/edit') }}" id="edit">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                        @endif
                                        @if (Auth::user()->level != 3)
                                            <a href="{{ url('pinjam/' . $item->id . '/edit') }}" id="edit">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ url('pinjam/' . $item->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Apakah kamu yakin?')" type="submit"
                                                    id="delete">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                            <button type="button" id="kembali"
                                                onclick="setbuku('{{ $item->id_buku }}|{{ $item->id }}')"
                                                data-bs-toggle="modal" data-bs-target="#modalBuku">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                                                </svg>
                                            </button>

                                            @if (Auth::user()->level == 1)
                                                <button type="button" id="persetujuan"
                                                    onclick="setsetuju('{{ $item->id }}|{{ $item->status_persetujuan }}')"
                                                    data-bs-toggle="modal" data-bs-target="#modalSetuju">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSetuju" tabindex="-1" aria-labelledby="modalSetujuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSetujuLabel">Ubah Status Persetujuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('persetujuan') }}" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status_persetujuan" class="form-label">Status Persetujuan</label>
                            <select type="text" class="form-select" id="status_persetujuan" name="status_persetujuan">
                                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                            <input type="hidden" class="form-control" id="id_setuju" name="id_setuju">
                            @csrf
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

    <div class="modal fade" id="modalBuku" tabindex="-1" aria-labelledby="modalBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBukuLabel">Informasi Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('dikembalikan') }}" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal_dikembalikan" class="form-label">Tanggal Dikembalikan</label>
                            <input type="text" class="form-control datepicker" id="tanggal_dikembalikan"
                                name="tanggal_dikembalikan">
                            <input type="hidden" class="form-control" id="id_buku" name="id_buku">
                            <input type="hidden" class="form-control" id="id_pinjam" name="id_pinjam">
                            @csrf
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

    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/bootstrap-datepicker.id.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });

        function setbuku(id) {
            var data = id.split('|');

            $('#id_buku').val(data[0]);
            $('#id_pinjam').val(data[1]);
        }

        function setsetuju(data) {
            var data = data.split('|');

            console.log(data);

            $('#id_setuju').val(data[0]);
            $('#status_persetujuan').val(data[1]);
        }

        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endsection
