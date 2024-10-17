@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="container">
    <h1 class="text-center">Daftar Peminjaman</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('loans.create') }}" class="btn btn-primary">Pinjam Buku</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Buku</th>
                <th>Member</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->member->name }}</td>
                    <td>{{ $loan->borrow_date }}</td>
                    <td>{{ $loan->return_date }}</td>
                    <td>{{ $loan->status }}</td>
                    <td>
                        <a href="{{ route('loans.edit', $loan) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
