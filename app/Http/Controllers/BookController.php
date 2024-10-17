<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan data buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Menampilkan form edit buku
    public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}

    // Mengupdate data buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        $bookBefore = Book::where('id', $id)->first();
        //cek jika stok yang dimasukan oleh input lebih kecil dari stok sebelumnya, maka tidak bisa mengubah data
        if ($request->stock < $bookBefore->stock) {
            return redirect()->back()->with('failed', 'Stok buku tidak boleh kurang dari sebelumnya!');
        }
        //jika stok input >= stok sebelumnya,maka data sebelumnya akan diubah
            $proses = $bookBefore->update([
                'title' => $request->title,
                'author' => $request->author,
                'stock' => $request->stock
                
            ]);
            if ($proses) {
                return redirect()->route('books.index')->with('success', 'Berhasil Mengubah Data Buku!');
            }
            else{
                return redirect()->back()->with('failed', 'Gagal Mengubah Data Buku!');
            }
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();
    
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
    public function show(Book $book)
{
    return view('books.show', compact('book'));
}

    
    
}
