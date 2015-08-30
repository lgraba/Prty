<?php

namespace Prty\Models\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // Return first name or full name, depending on what's there
    public function getName()
    {
        if($this->first_name) {
            if($this->last_name) {
                return "{$this->first_name} {$this->last_name}";
            }
            else {
                return $this->first_name;
            }
        }
        return null;
    }

    // Return name or username
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    // Return first name or username
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }
}
