<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Role';

        $roles = Role::orderBy('nama_role')
            ->withCount('users')
            ->get();

        return view('roles.index', compact('title', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => ['required', 'string', 'max:100', 'unique:role,nama_role'],
        ]);

        $role = Role::create(['nama_role' => $validated['nama_role']]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil ditambahkan.',
            'data'    => [
                'idrole'    => $role->idrole,
                'nama_role' => $role->nama_role,
            ],
        ]);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'idrole'    => $role->idrole,
                'nama_role' => $role->nama_role,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'nama_role' => [
                'required', 'string', 'max:100',
                Rule::unique('role', 'nama_role')->ignore($role->idrole, 'idrole')
            ],
        ]);

        $role->nama_role = $validated['nama_role'];
        $role->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil diperbarui.',
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:role,idrole']
        ]);

        $role = Role::findOrFail($request->id);

        if ($role->nama_role === 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Role admin tidak boleh dihapus.'
            ], 422);
        }

        // Check if role has users
        if ($role->users()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role tidak bisa dihapus karena masih memiliki user.'
            ], 422);
        }

        $role->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil dihapus.',
        ]);
    }
}
