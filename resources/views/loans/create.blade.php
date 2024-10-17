@extends('layouts.app')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <h1 class="text-centre">Form Peminjaman Buku</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="book_id">Buku:</label>
            <select name="book_id" id="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="member_id">Anggota:</label>
            <select name="member_id" id="member_id" class="form-control" required>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="borrow_date">Tanggal Pinjam:</label>
            <input type="date" name="borrow_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="return_date">Tanggal Kembali:</label>
            <input type="date" name="return_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Pinjam Buku</button>
    </form>
</div>
@endsection
