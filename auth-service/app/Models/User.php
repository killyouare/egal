<?php

namespace App\Models;

use App\Events\LoginUserEvent;
use App\Exceptions\EmptyPasswordException;
use App\Events\SaveModelUserEvent;
use Egal\Auth\Tokens\UserMasterRefreshToken;
use Egal\Auth\Tokens\UserMasterToken;
use Egal\AuthServiceDependencies\Exceptions\LoginException;
use Egal\AuthServiceDependencies\Models\User as BaseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

/**
 * @property $id                        {@property-type field}  {@primary-key}
 * @property $email                     {@property-type field}
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
 * @action register                     {@statuses-access guest}
 * @action login                        {@statuses-access guest}
 * @action loginToService               {@statuses-access guest}
 * @action refreshUserMasterToken       {@statuses-access guest}
 * @action getItems                     {@roles-access admin}
 */
class User extends BaseUser
{
    use HasFactory;
    use HasRelationships;

    public $incrementing = false;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'login_time' => 'array',
    ];

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'id',
        "email",
        'last_name',
        'first_name',
        'phone',
        "password",
        "login_time"
    ];

    protected $dispatchesEvents = [
        'creating' => SaveModelUserEvent::class,
    ];

    public static function actionRegister($attributes = []): User
    {
        $user = new static();

        $user->fill($attributes);
        $user->save();

        return $user;
    }


    public static function actionLogin(string $email, string $password): array
    {
        $user = self::query()
            ->where('email', '=', $email)
            ->first();

        if (!$user || !password_verify($password, $user->getAttribute('password'))) {
            throw new LoginException('Incorrect Email or password!');
        }

        event(new LoginUserEvent($user));

        $umt = new UserMasterToken();
        $umt->setSigningKey(config('app.service_key'));
        $umt->setAuthIdentification($user->getAuthIdentifier());

        $umrt = new UserMasterRefreshToken();
        $umrt->setSigningKey(config('app.service_key'));
        $umrt->setAuthIdentification($user->getAuthIdentifier());

        return [
            'user_master_token' => $umt->generateJWT(),
            'user_master_refresh_token' => $umrt->generateJWT()
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions(): HasManyDeep
    {
        return $this->hasManyDeep(
            Permission::class,
            [UserRole::class, Role::class, RolePermission::class],
            ['user_id', 'id', 'role_id', 'id'],
            ['id', 'role_id', 'id', 'permission_id']
        );
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function (User $user) {
            $defaultRoles = Role::query()
                ->where('is_default', true)
                ->get();
            $user->roles()
                ->attach($defaultRoles->pluck('id'));
        });
    }

    protected function password(): Attribute
    {
        return Attribute::set(
            fn ($value) => password_hash($value, PASSWORD_BCRYPT),
        );
    }

    protected function getRoles(): array
    {
        return array_unique($this->roles->pluck('id')->toArray());
    }

    protected function getPermissions(): array
    {
        return array_unique($this->permissions->pluck('id')->toArray());
    }
}
