<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $title = 'Master Pemilik';
        $pemilik = Pemilik::with('user')->orderBy('created_at', 'desc')->get();
        $users = User::orderBy('name')->get();
        
        return view('pemilik.index', compact('title', 'pemilik', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_wa' => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:100'],
            'iduser' => ['required', 'integer', 'exists:users,id'],
        ]);

        $pemilik = Pemilik::create($validated);
        $pemilik->load('user');

        return response()->json([
            'status'  => 'success',
            'message' => 'Pemilik berhasil ditambahkan.',
            'data'    => $pemilik,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        $validated = $request->validate([
            'no_wa' => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:100'],
            'iduser' => ['required', 'integer', 'exists:users,id'],
        ]);

        $pemilik->update($validated);
        $pemilik->load('user');

        return response()->json([
            'status'  => 'success',
            'message' => 'Pemilik berhasil diperbarui.',
            'data'    => $pemilik,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:pemilik,idpemilik'],
        ]);

        $pemilik = Pemilik::findOrFail($request->id);
        $pemilik->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pemilik berhasil dihapus.',
        ]);
    }

    
}
