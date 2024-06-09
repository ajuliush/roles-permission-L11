<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = 'permission_role';

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    static public function insertUpdateRecord($permission_ids, $role_id)
    {
        // Delete existing records for the role
        PermissionRole::where('role_id', '=', $role_id)->delete();

        // Ensure $permission_ids is an array
        $permission_ids = is_array($permission_ids) ? $permission_ids : [];

        // Insert new records
        foreach ($permission_ids as $permission_id) {
            $save = new PermissionRole;
            $save->permission_id = $permission_id;
            $save->role_id = $role_id;
            $save->save();
        }
    }

    static public function getRolePermission($role_id)
    {
        return PermissionRole::where('role_id', '=', $role_id)->get();
    }

    static public function getPermission($slug, $role_id)
    {
        return PermissionRole::select('permission_role.id')->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('permission_role.role_id', '=', $role_id)
            ->where('permissions.slug', '=', $slug)->count();
    }
}
