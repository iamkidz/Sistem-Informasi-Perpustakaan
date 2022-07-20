@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/selectpicker/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/bootstrap-datepicker3.standalone.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Tambah Peminjam</div>
            <div class="card-body">
                <form action="{{ url('pinjam') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_user" class="form-label">Nama User</label>
                        <select type="text" class="form-control selectpicker" id="id_user" name="id_user"
                            data-live-search="true">
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
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
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="text" class="form-control datepicker" id="tanggal_pinjam" name="tanggal_pinjam">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="text" class="form-control datepicker" id="tanggal_kembali" name="tanggal_kembali">
                    </div>
                    <div class="text-right">
                        <a href="{{ empty(request('id_buku')) ? url('pinjam') : url('buku') }}" type="button"
                            class="btn btn-secondary">Kembali</a>
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
    </script>
@endsection
