<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property User[] $users
 * @property Permission[] $permissions
 */
class Role extends Model
{
    protected static string $table = 'roles';
    protected static array $columns = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}