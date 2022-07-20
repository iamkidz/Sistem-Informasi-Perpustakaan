<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DataHilang;
use App\Models\RiwayatStok;
use Illuminate\Http\Request;

class DataHilangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DataHilang::get();
        $buku = Buku::get();

        return view('hilang.index', compact('data', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DataHilang::create($request->all());

        $buku = Buku::find($request->id_buku);
        $buku->decrement('jumlah_buku', $request->jumlah);
        $buku->save();

        RiwayatStok::create([
            'id_buku' => $request->id_buku,
            'jenis' => 'hilang_rusak',
            'jumlah' => -1 * abs($request->jumlah)
        ]);

        notify()->success('Data berhasil ditambahkan!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataHilang  $dataHilang
     * @return \Illuminate\Http\Response
     */
    public function show(DataHilang $dataHilang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataHilang  $dataHilang
     * @return \Illuminate\Http\Response
     */
    public function edit(DataHilang $dataHilang)
    {
        $data = $dataHilang;
        $buku = Buku::get();

        return view('hilang.edit', compact('data', 'buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataHilang  $dataHilang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataHilang $dataHilang)
    {
        if($dataHilang->jumlah != $request->jumlah) {
            $buku = Buku::find($dataHilang->id_buku);
            $buku->increment('jumlah_buku', $dataHilang->jumlah);
            $buku->save();

            $buku = Buku::find($dataHilang->id_buku);
            $buku->decrement('jumlah_buku', $request->jumlah);
            $buku->save();

            RiwayatStok::create([
                'id_buku' => $dataHilang->id_buku,
                'jenis' => 'dikembalikan',
                'jumlah' => $dataHilang->jumlah
            ]);

            RiwayatStok::create([
                'id_buku' => $request->id_buku,
                'jenis' => 'hilang_rusak',
                'jumlah' => -1 * abs($request->jumlah)
            ]);
        }

        $dataHilang->update($request->all());

        notify()->success('Data berhasil diubah!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataHilang  $dataHilang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataHilang $dataHilang)
    {
        $buku = Buku::find($dataHilang->id_buku);
        $buku->increment('jumlah_buku', $dataHilang->jumlah);
        $buku->save();

        RiwayatStok::create([
            'id_buku' => $dataHilang->id_buku,
            'jenis' => 'dikembalikan',
            'jumlah' => $dataHilang->jumlah
        ]);

        $dataHilang->delete();

        notify()->success('Data berhasil dihapus!');

        return back();
    }
}
