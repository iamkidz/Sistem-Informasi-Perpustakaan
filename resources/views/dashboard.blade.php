@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
    <style>
        svg {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .jml {
            margin-left: auto;
            margin-right: auto;
            display: block;
            font-weight: 800;
            font-size: 3em;
            text-align: center;
            color: rgb(25, 135, 84);
        }

    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Selamat datang <strong>{{ Auth::user()->nama }}</strong> di Sistem Perpustakaan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center text-white card-header bg-success">Jumlah Buku</div>

                    <div class="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                            style="fill:rgb(25,135,84);transform: ;msFilter:;">
                            <path
                                d="M6.012 18H21V4a2 2 0 0 0-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1zM8 6h9v2H8V6z">
                            </path>
                        </svg>

                        <span class="jml count">{{ $total_buku }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center text-white card-header bg-success">Jumlah Peminjam</div>
                    <div class="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                            style="fill:rgb(25, 135, 84);transform: ;msFilter:;">
                            <path
                                d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm-1 4v2h-5V7h5zm-5 4h5v2h-5v-2zM4 19V5h7v14H4z">
                            </path>
                        </svg>
                        <span class="jml count">{{ $total_peminjam }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center text-white card-header bg-success">Jumlah Pengguna</div>

                    <div class="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                            style="fill:rgb(25,135,84);transform: ;msFilter:;">
                            <path
                                d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z">
                            </path>
                        </svg>

                        <span class="jml count">{{ $total_user }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.count').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1000,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
@endsection
