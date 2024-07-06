<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
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
        $permissionResponse = $this->checkPermission('Category');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $data = [
            'PermissionAdd' => PermissionRole::getPermission('Add Category', Auth::user()->role_id),
            'PermissionEdit' => PermissionRole::getPermission('Edit Category', Auth::user()->role_id),
            'PermissionDelete' => PermissionRole::getPermission('Delete Category', Auth::user()->role_id),
        ];
        // Get search term from request
        $search = $request->input('search');

        // Fetch the filtered records
        $data['getRecord'] = Category::getRecord($search);

        return view('panel.category.list', $data);
    }
    public function store(Request $request)
    {
        $permissionResponse = $this->checkPermission('Add Category');
        if ($permissionResponse) {
            return $permissionResponse;
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create(['name' => $validatedData['name']]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }
}
