<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    //
    public function index()
    {
        $products = Products::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('images'), $imagePath);
        }

        Products::create([
            'gambar' => $imagePath,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $product = Products::findOrFail($id);

        $imagePath = $product->gambar;
        if ($request->hasFile('gambar')) {
            // if ($product->gambar) {
            //     unlink(public_path('images/' . $product->gambar));
            // }
            $imagePath = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('images'), $imagePath);
            $product->gambar = $imagePath;
        }

        $product->update([
            'gambar' => $imagePath,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        // if ($product->image) {
        //     unlink(public_path('images/' . $product->image));
        // }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function cetakPdf()
    {
        $products = Products::all();
        $pdf = Pdf::loadView('admin.products.pdf', compact('products'));

        return $pdf->stream('products.pdf');
    }
}