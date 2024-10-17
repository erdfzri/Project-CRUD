<?php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'member'])->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::all();
        $members = Member::all();
        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'member_id' => 'required|exists:members,id',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after:borrow_date', // Pastikan return_date setelah borrow_date
    ]);

    // Cek stok buku
    $book = Book::find($request->book_id);
    if ($book->stock <= 0) {
        return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam. Stok habis.')->withInput();
    }

    // Buat peminjaman baru
    $loan = new Loan();
    $loan->book_id = $request->book_id;
    $loan->member_id = $request->member_id;
    $loan->borrow_date = $request->borrow_date;
    $loan->return_date = $request->return_date;

    // Simpan peminjaman
    $loan->save();

    // Kurangi stok buku
    $book->stock -= 1;
    $book->save();

    return redirect()->route('loans.index')->with('success', 'Buku berhasil dipinjam.');
}

    public function edit(Loan $loan)
    {
        $books = Book::all();
        $members = Member::all();
        return view('loans.edit', compact('loan', 'books', 'members'));
    }

    public function update(Request $request, $id)
{
    $loan = Loan::find($id);

    if (!$loan) {
        return redirect()->route('loans.index')->with('error', 'Data peminjaman tidak ditemukan.');
    }

    // Validasi input jika perlu
    $request->validate([
        'book_id' => 'required',
        'member_id' => 'required',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date',
    ]);

    // Update data
    $loan->book_id = $request->input('book_id');
    $loan->member_id = $request->input('member_id');
    $loan->borrow_date = $request->input('borrow_date');
    $loan->return_date = $request->input('return_date');

    $loan->save();

    return redirect()->route('loans.index')->with('success', 'Data peminjaman berhasil diperbarui.');
}
public function show($id)
{
    // // Mencari pinjaman berdasarkan ID
    // $loan = Loan::with(['book', 'member'])->find($id);

    // // Cek apakah pinjaman ditemukan
    // if (!$loan) {
    //     return redirect()->route('loans.index')->with('error', 'Pinjaman tidak ditemukan');
    // }

    // // Mengembalikan tampilan dengan data pinjaman
    // return view('loans.show', compact('loan'));
}


    
    public function destroy($id)
    {
        // Cari data peminjaman berdasarkan ID
        $loan = Loan::find($id);
        
        // Hapus data
    $loan->delete();

    return redirect()->route('loans.index')->with('success', 'Data peminjaman berhasil dihapus.');
}

}
