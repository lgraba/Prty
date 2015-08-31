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

    /**
     * User
     */

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


    /**
     * Statuses
     */
    // Relate User and Status - foreign key (in statuses table) is 'user_id', which will be the id in users table
    public function statuses()
    {
        return $this->hasMany('Prty\Models\Status\Status', 'user_id');
    }


    /**
     * Friends
     */

    // The friends a given user has - relationship
    public function friendsOfMine()
    {
        // This ties it to the user model for relational mapping
        // Pivot table: friends
        // Matching them up by the user_id and friend_id
        return $this->belongsToMany('Prty\Models\User\User', 'friends', 'friend_id', 'user_id')->withTimestamps();
    }


    // The users who have the given user as a friend - relationship
    public function friendOf()
    {
        // Note the user_id and friend_id locations are reversed from above
        return $this->belongsToMany('Prty\Models\User\User', 'friends' ,'user_id', 'friend_id')->withTimestamps();
    }

    // To return friends of the user
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

    // To return friend requests of the user
    public function friendRequests()
    {
        return $this
                ->friendsOfMine()
                ->wherePivot('accepted', false)
                ->get();
    }

    // Get any pending friend requests using friendOf relationship
    public function friendRequestsPending()
    {
        return $this
                ->friendOf()
                ->wherePivot('accepted', false)
                ->get();
    }

    // Check if a user has a friend request pending from another user
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this
                        ->friendRequestsPending()
                        ->where('id', $user->id)
                        ->count();
    }

    // Check if we have received a friend request from another particular user
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this
                        ->friendRequests()
                        ->where('id', $user->id)
                        ->count();
    }

    // Add a friend
    public function addFriend(User $user)
    {
        $this
            ->friendOf()
            ->attach($user->id);
    }

    // Accept a friend request
    public function acceptFriendRequest(User $user)
    {
        $this
            ->friendRequests()
            ->where('id', $user->id)
            ->first()
            ->pivot
            ->update([
                'accepted' => true,
            ]);
    }

    // Are we friends with a particular user?
    public function isFriendsWith(User $user)
    {
        return (bool) $this
                        ->friends()
                        ->where('id', $user->id)
                        ->count();
    }
}
