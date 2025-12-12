<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Many-to-many relationship dengan Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    /**
     * Check apakah user memiliki role tertentu
     * 
     * @param string $roleName
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('nama_role', $roleName)->where('status', 1)->exists();
    }

    /**
     * Assign role ke user
     * 
     * @param string $roleName
     * @return $this
     */
    public function assignRole(string $roleName): self
    {
        $role = Role::where('nama_role', $roleName)->first();
        if ($role && !$this->hasRole($roleName)) {
            $this->roles()->attach($role->idrole, ['status' => 1]);
        }
        return $this;
    }

    /**
     * Remove role dari user
     * 
     * @param string $roleName
     * @return $this
     */
    public function removeRole(string $roleName): self
    {
        $role = Role::where('nama_role', $roleName)->first();
        if ($role) {
            $this->roles()->detach($role->idrole);
        }
        return $this;
    }
}
