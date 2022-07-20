<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\RiwayatStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->level != 3) {
            $pinjam = Peminjaman::latest()->get();
        } else {
            $pinjam = Peminjaman::where('id_user', Auth::id())->latest()->get();
        }

        return view('pinjam.index', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(empty(request('id_buku'))) {
            $buku = Buku::get();
        }
        else {
            $buku = Buku::where('id', request('id_buku'))->get();
        }

        if(Auth::user()->level != 3) {
            $user = User::get();
        } else {
            $user = User::where('id', Auth::id())->get();
        }

        return view('pinjam.create', compact('user', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Peminjaman::create($request->all());

        $buku = Buku::find($request->id_buku);
        $buku->decrement('jumlah_buku');
        $buku->save();

        RiwayatStok::create([
            'id_buku' => $request->id_buku,
            'jenis' => 'dipinjam',
            'jumlah' => -1
        ]);


        notify()->success('Data berhasil ditambahkan!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $pinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $pinjam)
    {
        $buku = Buku::get();
        $user = User::get();

        return view('pinjam.edit', compact('pinjam', 'buku', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $pinjam)
    {
        $pinjam->update($request->all());

        notify()->success('Data berhasil diubah!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $pinjam)
    {
        if($pinjam->status_pinjam == "Belum Dikembalikan") {
            $buku = Buku::find($pinjam->id_buku);
            $buku->increment('jumlah_buku');
            $buku->save();

            RiwayatStok::create([
                'id_buku' => $pinjam->id_buku,
                'jenis' => 'dikembalikan',
                'jumlah' => 1
            ]);

        }
    }

    public function dikembalikan(Request $request) {
        $pinjam = Peminjaman::find($request->id_pinjam);
        $pinjam->tanggal_dikembalikan = $request->tanggal_dikembalikan;
        $pinjam->status_pinjam = 'Sudah Dikembalikan';
        $pinjam->save();

        $buku = Buku::find($request->id_buku);
        $buku->increment('jumlah_buku');
        $buku->save();

        RiwayatStok::create([
            'id_buku' => $pinjam->id_buku,
            'jenis' => 'dikembalikan',
            'jumlah' => 1
        ]);

        notify()->success('Data berhasil disimpan!');

        return back();
    }

    public function persetujuan(Request $request) {
        $pinjam = Peminjaman::find($request->id_setuju);
        $pinjam->status_persetujuan = $request->status_persetujuan;
        $pinjam->save();

        notify()->success('Data berhasil disimpan!');

        return back();
    }
}
