<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:members,email',
    //     ]);

    //     Member::create($request->all());
    //     return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan!');
    // }
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255|unique:members,name', // Unik berdasarkan nama
        'email' => 'required|string|email|max:255|unique:members,email', // Unik berdasarkan email
        // Tambahkan validasi lain sesuai kebutuhan
    ]);

    // Buat anggota baru
    $member = new Member();
    $member->name = $request->name;
    $member->email = $request->email;
    // Tambahkan atribut lain sesuai kebutuhan
    $member->save();

    return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan.');
}


    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
        ]);

        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

    return redirect()->route('members.index')->with('success', 'Akun berhasil dihapus.');
    }
}
