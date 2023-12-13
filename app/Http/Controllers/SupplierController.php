<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {

        $suppliers = Supplier::all();

        return view('dashboard.supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }

    public function store(Request $request)
    {
        $supplierExis = Supplier::where('nama', '=', $request->nama)->first();

        if ($supplierExis) {
            return redirect()->route('supplier.index')->with('error', 'Supplier (' . $request->nama . ') sudah ada.');
        } else {
            Supplier::create([
                'nama'     => $request->nama,
                'alamat'     => $request->alamat,
                'telepon'     => $request->telepon,
            ]);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambah.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update([
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'telepon'     => $request->telepon,
        ]);

        return redirect()->route('supplier.index')->with(['success' => 'Supplier berhasil diubah.']);
    }

    public function destroy(Supplier $supplier)
    {
        Supplier::destroy($supplier->id);

        return redirect()->back()->with('success', 'Supplier berhasil dihapus.');
    }
}
