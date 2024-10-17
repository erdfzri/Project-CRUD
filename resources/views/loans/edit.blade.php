@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Peminjaman</h1>

    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Pastikan ada method PUT untuk update -->
        
        <div class="form-group">
            <label for="book_id">Buku:</label>
            <select class="form-control" id="book_id" name="book_id" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" {{ $book->id == $loan->book_id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="member_id">Member:</label>
            <select class="form-control" id="member_id" name="member_id" required>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ $member->id == $loan->member_id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="borrow_date">Tanggal Pinjam:</label>
            <input type="date" class="form-control" id="borrow_date" name="borrow_date" value="{{ $loan->borrow_date }}" required>
        </div>

        <div class="form-group">
            <label for="return_date">Tanggal Kembali:</label>
            <input type="date" class="form-control" id="return_date" name="return_date" value="{{ $loan->return_date }}" required>
        </div>
{{-- 
        <button type="submit" class="btn btn-primary">Update</button> --}}
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Input lainnya -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        
    </form>
</div>
@endsection
