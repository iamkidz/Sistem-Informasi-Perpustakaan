@extends('layouts.app')
@section('title', 'Perpustakaan')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="mb-3 col-md-6">
                <h5 style="font-weight: 500;font-size:1.125rem">Data Buku</h5>
            </div>
            <div class="mb-3 text-right col-md-6">
                @if (Auth::user()->level != 3)
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalImport">Import Data</button>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalAdd">Tambah
                        Data</button>
                @endif
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

                        @foreach ($data as $item)
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
                                        <a href="{{ url('buku/' . $item->id) }}" id="detail">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        @if (Auth::user()->level != 3)
                                            <a href="{{ url('buku/' . $item->id . '/edit') }}" id="edit">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ url('buku/' . $item->id) }}" method="POST">
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
                                        @endif
                                        <a href="{{ url('pinjam/create?id_buku=' . $item->id) }}" type="button"
                                            id="pinjam">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        @if (Auth::user()->level != 3)
                                            <button type="button" onclick="setBuku('{{ $item->id }}')" id="tambahstok"
                                                data-bs-toggle="modal" data-bs-target="#tambahStok">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z">
                                                    </path>
                                                </svg>
                                            </button>
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

    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('buku') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_klasifikasi" class="form-label">No Klasifikasi</label>
                            <input type="text" class="form-control" id="no_klasifikasi" name="no_klasifikasi">
                        </div>
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul_buku" name="judul_buku">
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select type="text" class="form-select" id="jenis" name="jenis">
                                <option value="Pengayaan">Pengayaan</option>
                                <option value="Referensi">Referensi</option>
                                <option value="Paeda">Paeda</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mapel" class="form-label">Mapel</label>
                            <select type="text" class="form-select" id="mapel" name="mapel">
                                <option value="BI">BI</option>
                                <option value="IPA">IPA</option>
                                <option value="IPS">IPS</option>
                                <option value="KMS BI">KMS BI</option>
                                <option value="KMS INGG">KMS INGG</option>
                                <option value="MAT">MAT</option>
                                <option value="PAEDA">PAEDA</option>
                                <option value="PAI">PAI</option>
                                <option value="PENJAS">PENJAS</option>
                                <option value="PD">PD</option>
                                <option value="PKN">PKN</option>
                                <option value="SBK">SBK</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengarang" class="form-label">Nama Pengarang</label>
                            <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Nama Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                            <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku">
                        </div>
                        <div class="mb-3">
                            <label for="staf_penerima" class="form-label">Staf Penerima</label>
                            <input type="text" class="form-control" id="staf_penerima" name="staf_penerima">
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

    <div class="modal fade" id="tambahStok" tabindex="-1" aria-labelledby="tambahStokLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahStokLabel">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('tambahstok') }}" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="stok_baru" class="form-label">Jumlah Stok Baru</label>
                            <input type="number" class="form-control" id="stok_baru" name="stok_baru">
                            <input type="hidden" class="form-control" id="id_buku" name="id_buku">
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

    <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImportLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('import-buku') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                          <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                          </symbol>
                        </svg>
                        <div class="mb-0">
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                              <div>
                                  Contoh file dapat di download <a href="{{ url('contoh_data.xlsx') }}">di sini</a>
                              </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File Excel</label>
                            <input type="file" class="form-control" id="file" name="file">
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
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });

        function setBuku(id) {
            $('#id_buku').val(id);
        }
    </script>
@endsection
