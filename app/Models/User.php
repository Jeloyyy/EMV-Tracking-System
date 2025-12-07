<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'first_name', 'middle_name', 'last_name', 'ext_name',
        'email', 'password', 'department_id', 'role', 'stat', 'profile_photo'
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
    // app/Models/User.php

    public function getFullNameAttribute()
    {
        $name = $this->first_name;
        if ($this->middle_name) {
            $name .= ' ' . $this->middle_name;
        }
        $name .= ' ' . $this->last_name;
        if ($this->ext_name) {
            $name .= ', ' . $this->ext_name;
        }
        return $name;
    }

        public function getUserData()
    {
        $parts = array_filter([
            $this->first_name ?? '',
            $this->middle_name ?? '',
            $this->last_name ?? '',
            $this->ext_name ?? '',
        ]);
        return trim(implode(' ', $parts));
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function issuedSupplies()
    {
        return $this->hasMany(IssuedSupply::class);
    }

    /**
     * Check if the user has a specific role or one of an array of roles.
     *
     * @param  string|array  $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return in_array($this->role ?? null, $role);
        }

        return ($this->role ?? null) === $role;
    }

    /**
     * Check if the user has any of the given roles.
     *
     * @param  array  $roles
     * @return bool
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role ?? null, $roles);
    }
}