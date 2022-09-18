<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles {
        hasPermissionTo as hasPermissionToOriginal;
    }

    public function hasPermissionTo($permission, $guardName = 'web'): bool
    {
        // Since this method comes from a trait,
        // you cannot simply `parent::hasPermissionTo($permission, '*')`.
        // You'll have to copy the entire body of the method into yours.
        // Just replace '*' with the "guard" name from above.
        return $this->hasPermissionToOriginal($permission, $guardName);
    }

    protected function getDefaultGuardName(): string
    {
        return 'web';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'is_admin','failed_login_attempts'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return intval($this->is_admin) > 0;
    }

    public function isActive()
    {
        return intval($this->active) > 0;
    }
}
