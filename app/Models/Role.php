<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    static public function getRecord($search = null)
    {
        $query = self::orderBy('id', 'DESC');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        return $query->paginate(10);
    }
    static public function getAllRoles()
    {
        return Role::all();
    }
    static public function getSingle($id)
    {
        return Role::find($id);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
