<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DataHilang;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function buku()
    {
        $buku = Buku::get();

        return view('report.buku', compact('buku'));
    }

    public function pinjam() {
        $pinjam = Peminjaman::get();

        return view('report.pinjam', compact('pinjam'));
    }


    public function hilang() {
        $hilang = DataHilang::get();

        return view('report.hilang', compact('hilang'));
    }

    public function per_buku($id) {
        $buku = Buku::findOrFail($id);

        $pdf = PDF::loadView('report.per_buku', compact('buku'));
        return $pdf->download('Detail Buku - '.$buku->judul_buku);
    }

    public function per_pinjam($id) {
        $pinjam = Peminjaman::findOrFail($id);

        $pdf = PDF::loadView('report.per_pinjam', compact('pinjam'));
        return $pdf->download('Detail Peminjaman - '.$pinjam->user->nama.' - ' .$pinjam->buku->judul_buku);
    }


    public function per_hilang($id) {
        $hilang = DataHilang::findOrFail($id);

        $pdf = PDF::loadView('report.per_hilang', compact('hilang'));
        return $pdf->download('Detail Data Hilang - '.$hilang->buku->judul_buku);
    }

    public function pinjam_bulanan(Request $request) {
        $bulan = $request->bulan;
        $bulan = explode('-', $bulan);

        $nama_bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $jenis = $nama_bulan[(int)$bulan[0]]. ' ' .$bulan[1];

        $pinjam = Peminjaman::whereMonth('tanggal_pinjam', '=', $bulan[0])->whereYear('tanggal_pinjam', '=', $bulan[1])->get();

        $pdf = PDF::loadView('report.pinjam_semua', compact('pinjam', 'jenis'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Peminjaman - '.$request->bulan);
    }

    public function pinjam_tahunan(Request $request) {
        $pinjam = Peminjaman::whereYear('tanggal_pinjam', '=', $request->tahun)->get();
        $jenis = 'Tahun '.$request->tahun;
        $pdf = PDF::loadView('report.pinjam_semua', compact('pinjam', 'jenis'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Peminjaman - '.$request->tahun);
    }

    public function pinjam_semua() {
        $pinjam = Peminjaman::get();
        $jenis = '';
        $pdf = PDF::loadView('report.pinjam_semua', compact('pinjam', 'jenis'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Peminjaman - Semua');
    }

    public function buku_semua() {
        $buku = Buku::get();
        $pdf = PDF::loadView('report.buku_semua', compact('buku'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Buku - Semua');
    }

    public function hilang_bulanan(Request $request) {
        $bulan = $request->bulan;
        $bulan = explode('-', $bulan);

        $nama_bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $jenis = $nama_bulan[(int)$bulan[0]]. ' ' .$bulan[1];

        $hilang = DataHilang::whereMonth('tanggal', '=', $bulan[0])->whereYear('tanggal', '=', $bulan[1])->get();

        $pdf = PDF::loadView('report.hilang_semua', compact('hilang', 'jenis'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Hilang - '.$request->bulan);
    }

    public function hilang_tahunan(Request $request) {
        $hilang = DataHilang::whereYear('tanggal', '=', $request->tahun)->get();
        $jenis = 'Tahun '.$request->tahun;
        $pdf = PDF::loadView('report.hilang_semua', compact('hilang', 'jenis'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Hilang - '.$request->tahun);
    }

    public function hilang_semua() {
        $hilang = DataHilang::get();
        $jenis = '';
        $pdf = PDF::loadView('report.hilang_semua', compact('hilang', 'jenis'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Report Hilang - Semua');
    }
}
