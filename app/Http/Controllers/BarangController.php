<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::table('tb_barang')->get();

        return view('Barang', ['barang' => $barang]);    
    }

    public function tambah()
    {
        return view('tambahBarang');
    }

    public function simpan(Request $request)
    {
        $this->validate($request,[
            'nama_brg' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required'
        ]);

        DB::table('tb_barang')->insert([
            'nama_brg' => $request->nama_brg,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);
        return view('simpan',['data' => $request]);
    }

    public function edit($id_brg)
    {
        $barang = DB::table('tb_barang')->where('id_brg',$id_brg)->get();

        return view('editBarang', ['barang' => $barang]);
    }

    public function update(Request $request)
    {
        DB::table('tb_barang')->where('id_brg',$request->id_brg)->update([
            'nama_brg' => $request->nama_brg,
            'keterangan' => $request->keterangan,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);
        return redirect('/barang');
    }

    public function hapus($id_brg)
    {
        DB::table('tb_barang')->where('id_brg',$id_brg)->delete();

        return redirect('/barang');
    }

    
}
