<?php

namespace App\Models;

use App\Exceptions\EmptyPasswordException;
use App\Exceptions\PasswordHashException;
use App\Events\SaveModelUserEvent;
use Egal\Auth\Tokens\UserMasterRefreshToken;
use Egal\Auth\Tokens\UserMasterToken;
use Egal\Auth\Tokens\UserServiceToken;
use Egal\AuthServiceDependencies\Exceptions\LoginException;
use Egal\AuthServiceDependencies\Exceptions\UserNotIdentifiedException;
use Egal\AuthServiceDependencies\Models\User as BaseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * @property $id            {@property-type field}  {@primary-key}
 * @property $email         {@property-type field}  {@validation-rules required|string|email|unique:users,email}
 * @property $password      {@property-type field}  
 * @property $last_name     {@property-type fake-field} 
 * @property $phone     {@property-type fake-field} 
 * @property $first_name     {@property-type fake-field} 
 * @property $created_at    {@property-type field}
 * @property $updated_at    {@property-type field}
 * @property Collection $roles          {@property-type relation}
 * @property Collection $permissions    {@property-type relation}
 *
 * @action register                     {@statuses-access guest}
 * @action login                        {@statuses-access guest}
 * @action loginToService               {@statuses-access guest}
 * @action refreshUserMasterToken       {@statuses-access guest}
 */
class User extends BaseUser
{

    use HasFactory;
    use HasRelationships;

    protected $hidden = [
        'password',
    ];
    protected $fillable = [
        'last_name',
        "id",
        'first_name',
        "phone"
    ];
    protected $guarder = [
        'created_at',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'saving' => SaveModelUserEvent::class,
    ];

    public static function actionRegister(array $arguments = []): User
    {
        if (!$arguments['password']) {
            throw new EmptyPasswordException();
        }

        $user = new static();
        $hashedPassword = password_hash($arguments['password'], PASSWORD_BCRYPT);

        if (!$hashedPassword) {
            throw new PasswordHashException();
        }
        $user->setAttribute("id", Str::uuid());
        $user->setAttribute('email', $arguments['email']);
        $user->setAttribute('password', $hashedPassword);
        $user->setAttribute('last_name', $arguments['last_name']);
        $user->setAttribute('first_name', $arguments['first_name']);
        $user->setAttribute('phone', $arguments['phone']);
        $user->save();

        return $user;
    }

    public static function actionLogin(string $email, string $password): array
    {
        /** @var BaseUser $user */
        $user = self::query()
            ->where('email', '=', $email)
            ->first();

        if (!$user || !password_verify($password, $user->getAttribute('password'))) {
            throw new LoginException('Incorrect Email or password!');
        }

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

    protected function getRoles(): array
    {
        return array_unique($this->roles->pluck('id')->toArray());
    }

    protected function getPermissions(): array
    {
        return array_unique($this->permissions->pluck('id')->toArray());
    }
}
