<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('dashboard.kategori.index', ['kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $kategoriExis = Kategori::where('nama_kategori', '=', $request->nama)->first();
        if ($kategoriExis) {
            return redirect()->route('kategori.index')->with('error', 'Kategori ('.$request->nama.') sudah ada.');
        } else {
            Kategori::create([
                'nama_kategori'     => $request->nama,
            ]);
        }

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambah.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $kategoriExis = Kategori::where('nama_kategori', '=', $request->nama)->first();
        if ($kategoriExis && ($request->nama !== $kategori->nama_kategori)) {
            return redirect()->route('kategori.index')->with('error', 'Kategori ('.$request->nama.') sudah ada.');
        } else {
            $kategori->update([
                'nama_kategori'   => $request->nama,
            ]);
        }
        
        return redirect()->route('kategori.index')->with(['success' => 'Kategori berhasil diubah.']);
    }

    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
