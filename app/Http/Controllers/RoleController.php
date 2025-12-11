<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Role';

        $roles = Role::with('permissions')
            ->orderBy('name')
            ->get();

        $permissions = Permission::orderBy('name')->get();

        return view('roles.index', compact('title', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name']
        ]);

        $role = Role::create(['name' => $validated['name']]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil ditambahkan.',
            'data'    => [
                'id'    => $role->id,
                'name'  => $role->name,
                'permissions' => $role->permissions->pluck('name'),
            ],
        ]);
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'          => $role->id,
                'name'        => $role->name,
                'permissions' => $role->permissions->pluck('name'),
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required','string','max:255',
                Rule::unique('roles', 'name')->ignore($role->id)
            ],
            'permissions' => ['nullable','array'],
            'permissions.*' => ['string','exists:permissions,name'],
        ]);

        $role->name = $validated['name'];
        $role->save();

        $role->syncPermissions($validated['permissions'] ?? []);

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil diperbarui.',
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required','integer','exists:roles,id']
        ]);

        $role = Role::findOrFail($request->id);

        if ($role->name === 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Role admin tidak boleh dihapus.'
            ], 422);
        }

        $role->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil dihapus.',
        ]);
    }
}
