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
            <div class="card-header">
                Ubah Data Hilang
            </div>
            <div class="card-body">
                <form action="{{ url('data-hilang/' . $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control datepicker" id="tanggal" name="tanggal"
                            value="{{ $data->tanggal }}">
                    </div>
                    <div class="mb-3">
                        <label for="id_buku" class="form-label">Judul Buku</label>
                        <select type="text" class="form-control selectpicker" id="id_buku" name="id_buku"
                            data-live-search="true" value="{{ $data->id_buku }}">
                            @foreach ($buku as $item)
                                <option value="{{ $item->id }}">{{ $item->judul_buku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select type="number" class="form-control" id="jenis" name="jenis" value="{{ $data->jenis }}">
                            <option value="hilang" {{ $data->jenis == 'hilang' ? 'selected' : '' }}>Hilang</option>
                            <option value="rusak" {{ $data->jenis == 'hilang' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                            value="{{ $data->jumlah }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="{{ $data->keterangan }}">
                    </div>
                    <div class="text-right">
                        <a type="button" href="{{ url('data-hilang') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Ubah</button>
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

        $('select[name=id_buku]').val("{{ $data->id_buku }}");
        $('.selectpicker').selectpicker('refresh');
    </script>
@endsection
