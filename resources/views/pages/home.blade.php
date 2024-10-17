@extends('layouts.app')

@section('title', 'Selamat Datang di Perpustakaan')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h1 class="display-4">Selamat Datang di Perpustakaan</h1>
        <p class="lead">Kelola buku, member, dan peminjaman dengan mudah melalui aplikasi perpustakaan kami.</p>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-book display-1 text-primary"></i> <!-- Ikon buku -->
                    <h3 class="card-title mt-3">Lihat Buku</h3>
                    <p class="card-text">Telusuri koleksi buku yang tersedia di perpustakaan.</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-block">Lihat Buku</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-users display-1 text-secondary"></i> <!-- Ikon member -->
                    <h3 class="card-title mt-3">Lihat Member</h3>
                    <p class="card-text">Kelola data member yang terdaftar di perpustakaan.</p>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary btn-block">Lihat Member</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="fas fa-book-reader display-1 text-success"></i> <!-- Ikon peminjaman -->
                    <h3 class="card-title mt-3">Lihat Peminjaman</h3>
                    <p class="card-text">Pantau aktivitas peminjaman buku oleh member.</p>
                    <a href="{{ route('loans.index') }}" class="btn btn-success btn-block">Lihat Peminjaman</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">&copy; 2024 Perpustakaan XYZ. All rights reserved.</p>
    </div>
</div>
@endsection
