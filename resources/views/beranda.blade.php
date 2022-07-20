@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-{{ Auth::check() ? '12' : '8' }}">
                <div class="card">
                    <div class="card-body">
                        <h2 style="font-size:calc(1.305rem + 0.66vw);  margin-top: 0;
                                                    margin-bottom: 0.5rem;
                                                    font-weight: 500;
                                                    line-height: 1.2;">SISTEM INFORMASI PERPUSTAKAAN DINAS</h2>

                        <p style="margin-bottom:1rem;margin-top:0">
                            Selamat datang di Sistem Informasi Perpustakaan Dinas Pendidikan dan Kebudayaan Gresik.
                            Melalui halaman ini dapat dilakukan pengelolaan data Buku Perpustakaan, pengelolaan peminjaman
                            Buku
                            Perpustakaan,
                            dan juga pengelolaan laporan Buku serta peminjamannya.
                        </p>

                        <p style="margin-bottom:1rem;margin-top:0">
                            Akses menu Master Data pada bagian atas sistem untuk pengelolaan data Buku dan data peminjaman
                            Buku.
                            Untuk mengelola laporan, dapat dilakukan dengan mengakses menu report pada bagian atas sistem.
                            Akses menu User untuk mengelola informasi tentang user yang login.
                        </p>
                    </div>
                </div>
            </div>
            @guest
                <div class="col-md-4">
                    <div class="card" id="register" style="display: none">
                        <div class="text-center text-white card-header bg-success">
                            <b>Daftar ke Sistem</b>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama" placeholder="Nama">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Password Confirmation">
                                </div>
                                <div class="mb-3">
                                    <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Register</button>
                                <div class="mt-2 text-center">
                                    <button type="button" class="btn btn-link text-decoration-none"
                                        onclick="loginform()">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card" id="login">
                        <div class="text-center text-white card-header bg-success">
                            <b>Masuk ke Sistem</b>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-success w-100">Login</button>
                                <div class="mt-2 text-center">
                                    <button type="button" class="btn btn-link text-decoration-none"
                                        onclick="registerform()">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
@endsection

@section('js')
    <script>
        function loginform() {
            $('#login').attr('style', 'display:block');
            $('#register').attr('style', 'display:none');
        }

        function registerform() {
            $('#register').attr('style', 'display:block');
            $('#login').attr('style', 'display:none');
        }
    </script>
@endsection
