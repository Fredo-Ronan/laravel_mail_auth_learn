<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function buku(){
        $userLoggedIn = Auth::user();

        $buku = Buku::where("id_penerbit", $userLoggedIn->getAuthIdentifier())->paginate(5);
        return view("buku", compact("buku"));
    }

    public function tambah() {
        return view("tambahBuku");
    }

    public function edit(Request $request) {
        $buku = Buku::find($request->id_buku);
        return view("editBuku", compact("buku"));
    }

    public function actionTambah(Request $request) {
        $userLoggedIn = Auth::user();
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
        ]);
        
        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'id_penerbit' => $userLoggedIn->id_user,
            'status' => 'Tersedia',
        ]);

        try {
            return redirect('/buku')->with('success','Berhasil Menambah Buku');
        } catch (Exception $e) {
            return redirect('/buku')->with('success','Gagal Menambah Buku');
        }
    }

    public function actionEdit(Request $request) {
        $bukuEdit = Buku::find($request->id_buku);

        $bukuEdit->update([
            'judul'=> $request->judul,
            'penulis'=> $request->penulis,
            'id_penerbit' => $bukuEdit->id_penerbit,
            'status' => $bukuEdit->status,
        ]);

        try {
            return redirect('buku')->with('success','Berhasil Edit Data Buku');
        } catch (Exception $e) {
            return redirect('buku')->with('success','Berhasil Edit Data Buku');
        }
    }

    public function actionDelete(Request $request) {
        $buku = Buku::find($request->id_buku);
        $buku->delete();
        return redirect('buku')->with('success','Berhasil Menghapus Data Buku');
    }
}
