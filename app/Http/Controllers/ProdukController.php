<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = DB::table('produks')
            ->leftJoin('kategoris as tabel_kategori', 'produks.id_kategori', '=', 'tabel_kategori.id')
            ->select(
                "produks.*",
                "tabel_kategori.nama_kategori as nama_kategori",
            )
            ->get();

        $kategoris = Kategori::all();

        return view('dashboard.produk.index', [
            'produks' => $produks,
            'kategoris' => $kategoris,
        ]);
    }

    public function store(Request $request)
    {
        $produkExis = Produk::where('nama_produk', '=', $request->nama)->first();
        $kode_produk = now()->format('YmdHis');
        // dd($kode_produk);

        if ($produkExis) {
            return redirect()->route('produk.index')->with('error', 'Produk (' . $request->nama . ') sudah ada.');
        } else {
            Produk::create([
                'id_kategori'     => $request->kategori,
                'kode_produk'     => $kode_produk,
                'nama_produk'     => $request->nama,
                'merk'     => $request->merk,
                'harga_beli'     => $request->harga_beli,
                'diskon'     => $request->diskon,
                'harga_jual'     => $request->harga_jual,
                'stok'     => $request->stok,
            ]);
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambah.');
    }

    public function update(Request $request, Produk $produk)
    {
        $produkExis = Produk::where('nama_produk', '=', $request->nama)->first();
        if ($produkExis && ($request->nama !== $produk->nama_produk)) {
            return redirect()->route('produk.index')->with('error', 'Produk (' . $request->nama . ') sudah ada.');
        } else {
            $produk->update([
                'id_kategori'     => $request->kategori,
                'nama_produk'     => $request->nama,
                'merk'     => $request->merk,
                'harga_beli'     => $request->harga_beli,
                'diskon'     => $request->diskon,
                'harga_jual'     => $request->harga_jual,
                'stok'     => $request->stok,
            ]);
        }

        return redirect()->route('produk.index')->with(['success' => 'Produk berhasil diubah.']);
    }

    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function deleteSelected(Request $request)
    {
        $selectedProduks = $request->input('selected_produks');
        dd($selectedProduks);

        // Check if there are selected produks
        if (!empty($selectedProduks)) {
            // Delete the selected produks
            Produk::whereIn('id', $selectedProduks)->delete();
            return redirect()->back()->with('success', 'Selected produk(s) deleted successfully');
        }

        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih');
    }
}
