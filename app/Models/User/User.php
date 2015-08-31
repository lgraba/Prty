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

    // Return avatar URL (Gravatar)
    public function getAvatarUrl()
    {
        $emailHash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/$emailHash?d=mm&s=66";
    }

    // The friends a given user has relationship
    public function friendsOfMine()
    {
        // This ties it to the user model for relational mapping
        // Pivot table: friends
        // Matching them up by the user_id and friend_id
        return $this->belongsToMany('Prty\Models\User\User', 'friends', 'user_id', 'friend_id');
    }


    // The users who have the given user as a friend relationship
    public function friendOf()
    {
        // Note the user_id and friend_id locations are reversed from above
        return $this->belongsToMany('Prty\Models\User\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        // Only return back accepted friends
        // Merge so that a given user is friends with me if I am friends with them and vice-versa.
        return $this
            ->friendsOfMine()
            ->wherePivot('accepted', true)
            ->get()
            ->merge($this
                ->friendOf()
                ->wherePivot('accepted', true)
                ->get());
    }
}
