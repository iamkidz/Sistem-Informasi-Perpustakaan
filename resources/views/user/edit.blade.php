@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Ubah Pengguna</div>
            <div class="card-body">
                <form action="{{ url('pengguna/' . $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select type="text" class="form-control" id="level" name="level" value="{{ $user->level }}">
                            <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $user->level == 2 ? 'selected' : '' }}>Penjaga</option>
                            <option value="3" {{ $user->level == 3 ? 'selected' : '' }}>Peminjam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat"
                            name="alamat">{{ $user->alamat }}</textarea>
                    </div>
                    <div class="text-right">
                        <a href="{{ url('pengguna') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
