<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string|unique:permissions,name'
        ]);

        Permission::create([
            'name' => $req->name,
            'guard_name' => 'web'
        ]);

        return response()->json(['message' => 'Permission berhasil ditambahkan.']);
    }

    public function show($id)
    {
        $p = Permission::findOrFail($id);

        return response()->json([
            'data' => [
                'id' => $p->id,
                'name' => $p->name
            ]
        ]);
    }

    public function update(Request $req, $id)
    {
        $p = Permission::findOrFail($id);

        $req->validate([
            'name' => "required|string|unique:permissions,name,$p->id"
        ]);

        $p->update(['name' => $req->name]);

        return response()->json(['message' => 'Permission berhasil diperbarui.']);
    }

    public function destroy(Request $req)
    {
        $req->validate(['id' => 'required|exists:permissions,id']);

        Permission::find($req->id)->delete();

        return response()->json(['message' => 'Permission berhasil dihapus.']);
    }
}
