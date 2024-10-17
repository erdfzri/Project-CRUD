@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Member</h1>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PATCH')

        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $member->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $member->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
