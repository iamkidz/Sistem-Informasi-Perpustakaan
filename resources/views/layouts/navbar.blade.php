<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Sistem Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    @if (Auth::user()->level != 3)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('home') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Auth::user()->level == 3 ? 'active' : '' }}"
                            href="{{ url('buku') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('pinjam') }}">Peminjaman</a>
                    </li>

                    @if (Auth::user()->level != 3)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('data-hilang') }}">Data Hilang</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="report" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Reporting
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="report">
                                <li><a class="dropdown-item" href="{{ url('report/buku') }}">Laporan Buku</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('report/pinjam') }}">Laporan Peminjaman</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('report/hilang') }}">Laporan Data
                                        Hilang</a>
                                </li>
                            </ul>
                        </li>

                        @if (Auth::user()->level == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('pengguna') }}">Pengguna</a>
                            </li>
                        @endif
                    @endif
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                </li>

                @if (Auth::check())
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a onclick="$(this).closest('form').submit()" class="nav-link" href="#">Logout</a>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
