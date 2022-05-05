<?php

namespace App\DebugModels;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property $id                        {@property-type field}  {@primary-key}
 * @property $email                     {@property-type field}  {@validation-rules required|string|email|unique:users,email}
 * @property $password                  {@property-type field}
 * @property $last_name                 {@property-type fake-field}
 * @property $phone                     {@property-type fake-field}
 * @property $first_name                {@property-type fake-field}
 * @property $created_at                {@property-type field}
 * @property $updated_at                {@property-type field}
 *
 * @property Collection $roles          {@property-type relation}
 * @property Collection $permissions    {@property-type relation}
 *
 */
class UserDebug extends User
{
    protected $table = "users";

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'id');
    }
}
