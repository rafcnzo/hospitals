<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Role';

        $roles = Role::orderBy('name')
            ->withCount(['users', 'permissions'])
            ->get();

        $permissions = Permission::orderBy('name')->get();

        return view('roles.index', compact('title', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role'   => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        DB::transaction(function () use ($request) {
            $role = Role::create(['name' => $request->nama_role]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }
        });

        return response()->json(['message' => 'Role berhasil dibuat']);
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        return response()->json([
            'data'            => $role,
            'rolePermissions' => $role->permissions->pluck('name'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role'   => 'required|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        DB::transaction(function () use ($request, $id) {
            $role = Role::findOrFail($id);
            $role->update(['name' => $request->nama_role]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
        });

        return response()->json(['message' => 'Role berhasil diupdate']);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $role = Role::findOrFail($request->id);

        if (strtolower($role->name) === 'admin') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Role admin tidak boleh dihapus.',
            ], 422);
        }

        if ($role->users()->count() > 0) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Role tidak bisa dihapus karena masih memiliki user aktif.',
            ], 422);
        }

        $role->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Role berhasil dihapus.',
        ]);
    }
}
