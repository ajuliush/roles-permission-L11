<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'slug',
        'groupby',
    ];

    // Method to get a single Permission by ID
    static public function getSingle($id)
    {
        return self::find($id); // Changed Role to self
    }

    // Method to get all records grouped by 'groupby'
    static public function getRecord()
    {
        // Eager load the permissions to reduce the number of queries
        $permissions = self::all()->groupBy('groupby');

        $result = [];

        foreach ($permissions as $groupby => $groupPermissions) {
            $group = [];
            foreach ($groupPermissions as $permission) {
                $group[] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            }
            $result[] = [
                'id' => $groupPermissions->first()->id, // Taking the first permission ID in the group
                'name' => $groupPermissions->first()->name, // Taking the first permission name in the group
                'group' => $group,
            ];
        }

        return $result;
    }

    // Method to get permissions by groupby value
    static public function getPermissionGroup($groupby)
    {
        return self::where('groupby', $groupby)->get();
    }
}
