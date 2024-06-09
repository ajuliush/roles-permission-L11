<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

class RoleController extends Controller
{
    private function checkPermission($action)
    {
        $permission = PermissionRole::getPermission($action, Auth::user()->role_id);
        if (empty($permission)) {
            abort(404);
        }
    }

    public function list()
    {
        $permissionResponse = $this->checkPermission('Role');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $data = [
            'PermissionAdd' => PermissionRole::getPermission('Add Role', Auth::user()->role_id),
            'PermissionEdit' => PermissionRole::getPermission('Edit Role', Auth::user()->role_id),
            'PermissionDelete' => PermissionRole::getPermission('Delete Role', Auth::user()->role_id),
            'getRecord' => Role::getRecord(),
        ];

        return view('panel.role.list', $data);
    }

    public function add()
    {
        $permissionResponse = $this->checkPermission('Add Role');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $data = ['getPermission' => Permission::getRecord()];

        return view('panel.role.add', $data);
    }

    public function store(Request $request)
    {
        $permissionResponse = $this->checkPermission('Add Role');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::create(['name' => $validatedData['name']]);

        PermissionRole::insertUpdateRecord($request->permission_id, $role->id);

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $permissionResponse = $this->checkPermission('Edit Role');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $data = [
            'getSingle' => Role::getSingle($id),
            'getPermission' => Permission::getRecord(),
            'getRolePermission' => PermissionRole::getRolePermission($id),
        ];

        return view('panel.role.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $permissionResponse = $this->checkPermission('Edit Role');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $validatedData['name']]);

        PermissionRole::insertUpdateRecord($request->input('permission_id', []), $role->id);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $permissionResponse = $this->checkPermission('Delete Role');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('error', 'Role deleted successfully.');
    }
}
