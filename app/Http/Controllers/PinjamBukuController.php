<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\PinjamBuku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamBukuController extends Controller
{
    public function index() {
        $userActive = Auth::user();
        $buku = Buku::with('users')->where("id_penerbit", "!=", $userActive->getAuthIdentifier())->where("status", "=", "Tersedia")->paginate(5);
        return view("pinjam", compact("buku"));
    }

    public function actionPinjam(Request $request) {
        $userActive = Auth::user();
        $bukuDipinjam = Buku::find($request->id_buku);

        $tglPinjam = date('Y-m-d');

        PinjamBuku::create([
            'id_buku' => $request->id_buku,
            'id_peminjam' => $userActive->getAuthIdentifier(),
            'tanggal_pinjam' => $tglPinjam,
            'tanggal_kembali' => null,
        ]);

        $bukuDipinjam->update([
            'id_buku' => $bukuDipinjam->id_buku,
            'id_penerbit' => $bukuDipinjam->id_penerbit,
            'judul' => $bukuDipinjam->judul,
            'penulis' => $bukuDipinjam->penulis,
            'status' => 'Dipinjam',
        ]);

        try {
            return redirect()->route('pinjam');
        } catch (Exception $e) {
            return redirect()->route('pinjam');
        }
    }

    public function daftarPinjam() {
        // $bukuDipinjam = Buku::with('users')->where("status", "=", "Dipinjam")->paginate(5);
        $userActive = Auth::user();
        $bukuDipinjam = PinjamBuku::join('bukus', 'pinjam_bukus.id_buku', '=', 'bukus.id_buku')
                                    ->join('users', 'pinjam_bukus.id_peminjam', '=', 'users.id_user')
                                    ->where("bukus.status", "=", 'Dipinjam')
                                    ->where('pinjam_bukus.id_peminjam', '=', $userActive->getAuthIdentifier())->paginate(5);
        return view("kembalikan", compact("bukuDipinjam"));
    }

    public function actionKembalikan(Request $request){
        $tglKembali = date('Y-m-d');
        $bukuDipinjam = PinjamBuku::find($request->id_pinjam_buku);

        $bukuDipinjam->update([
            'id_pinjam_buku'=> $bukuDipinjam->id_pinjam_buku,
            'id_buku' => $bukuDipinjam->id_buku,
            'id_peminjam' => $bukuDipinjam->id_peminjam,
            'tanggal_pinjam' => $bukuDipinjam->tanggal_pinjam,
            'tanggal_kembali' => $tglKembali,
        ]);

        $bukuDikembalikan = Buku::find($bukuDipinjam->id_buku);

        $bukuDikembalikan->update([
            'id_buku'=> $bukuDikembalikan->id_buku,
            'id_penerbit' => $bukuDikembalikan->id_penerbit,
            'judul' => $bukuDikembalikan->judul,
            'penulis' => $bukuDikembalikan->penulis,
            'status' => 'Tersedia',
        ]);

        try {
            return redirect()->route('kembalikan');
        } catch (Exception $e) {
            return redirect()->route('kembalikan');
        }
    }
}
