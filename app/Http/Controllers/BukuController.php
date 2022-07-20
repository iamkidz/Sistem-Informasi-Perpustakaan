<?php

namespace App\Http\Controllers;

use App\Imports\BukuImport;
use App\Models\Buku;
use App\Models\DataHilang;
use App\Models\Peminjaman;
use App\Models\RiwayatStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::get();

        return view('buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buku = Buku::insertGetId(request()->except(['_token']));

        RiwayatStok::create([
            'id_buku' => $buku,
            'jenis' => 'buku_baru',
            'jumlah' => $request->jumlah_buku
        ]);

        notify()->success('Data berhasil ditambahkan!');

        return redirect('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        $pinjam = Peminjaman::where('id_buku', $buku->id)->get();
        return view('buku.show', compact('buku', 'pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        DB::table('buku')->where('id', $buku->id)->update(request()->except(['_token', '_method']));

        notify()->success('Data berhasil diubah!');

        return redirect('buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        Peminjaman::where('id_buku', $buku->id)->delete();
        DataHilang::where('id_buku', $buku->id)->delete();
        RiwayatStok::where('id_buku', $buku->id)->delete();

        $buku->delete();
        notify()->success('Data berhasil dihapus!');

        return redirect('buku');
    }

    public function tambahstok(Request $request) {

        $jumlah_buku = (int)$request->stok_baru;

        $buku = Buku::find($request->id_buku);
        $buku->increment('jumlah_buku', $jumlah_buku);
        $buku->save();

        RiwayatStok::create([
            'id_buku' => $buku->id,
            'jenis' => 'tambah_stok',
            'jumlah' => $jumlah_buku
        ]);

        notify()->success('Stok berhasil ditambahkan!');

        return back();
    }

    public function import(Request $request) {
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        Excel::import(new BukuImport, $request->file('file'));

        notify()->success('Data buku berhasil diimpor!');

        return back();
    }
}
