<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class UserController extends Controller
{
    private function checkPermission($action)
    {
        $permission = PermissionRole::getPermission($action, Auth::user()->role_id);
        if (empty($permission)) {
            abort(404);
        }
    }
    public function list(Request $request)
    {
        $permissionResponse = $this->checkPermission('User');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        // Fetch permissions
        $data = [
            'PermissionAdd' => PermissionRole::getPermission('Add User', Auth::user()->role_id),
            'PermissionEdit' => PermissionRole::getPermission('Edit User', Auth::user()->role_id),
            'PermissionDelete' => PermissionRole::getPermission('Delete User', Auth::user()->role_id),
        ];

        // Get search term from request
        $search = $request->input('search');

        // Fetch the filtered records
        $data['getRecord'] = User::getRecord($search);

        return view('panel.user.list', $data);
    }


    public function add()
    {
        $permissionResponse = $this->checkPermission('Add User');
        if ($permissionResponse) {
            return $permissionResponse;
        }
        $data['getRecord'] = Role::getAllRoles();
        return view('panel.user.add', $data);
    }
    public function store(Request $request)
    {
        $permissionResponse = $this->checkPermission('Add User');
        if ($permissionResponse) {
            return $permissionResponse;
        }
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Ensure role_id exists in the roles table
        ]);

        // Create a new user
        $user = User::create([
            'name' => trim($validatedData['name']),
            'email' => trim($validatedData['email']),
            'password' => Hash::make($validatedData['password']),
            'role_id' => trim($validatedData['role_id']),
        ]);

        return redirect(url('panel/user'))->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $permissionResponse = $this->checkPermission('Edit User');
        if ($permissionResponse) {
            return $permissionResponse;
        }
        $data['getRecord'] = Role::getAllRoles();
        $data['getSingle'] = User::getSingle($id);
        return view('panel.user.edit', $data);
    }
    public function update($id, Request $request)
    {
        $permissionResponse = $this->checkPermission('Edit User');
        if ($permissionResponse) {
            return $permissionResponse;
        }
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->save();
        return redirect(url('panel/user'))->with('success', 'User update successfully.');
    }
    public function delete($id)
    {
        $permissionResponse = $this->checkPermission('Delete User');
        if ($permissionResponse) {
            return $permissionResponse;
        }
        $save = User::getSingle($id);
        $save->delete();
        return redirect(url('panel/user'))->with('error', 'User update successfully.');
    }
}
