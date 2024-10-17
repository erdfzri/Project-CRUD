@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Buku</h1>

    <!-- Ganti method GET menjadi POST -->
    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PATCH') <!-- Tetap gunakan PATCH untuk update -->

        <!-- Tampilkan pesan error jika update gagal -->
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

        <!-- Form input data buku -->
        <div class="form-group">
            <label for="title">Judul:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
        </div>

        <div class="form-group">
            <label for="author">Penulis:</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok:</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $book->stock }}" required>
        </div>

        <!-- Tombol submit untuk update -->
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
