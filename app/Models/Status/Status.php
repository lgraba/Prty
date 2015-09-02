<?php

// Status.php
// A status update model

namespace Prty\Models\Status;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $table = 'statuses';

	protected $fillable = [
		'body',
	];

	// Relate each Status to User via user_id
	public function user()
	{
		return $this->belongsTo('Prty\Models\User\User', 'user_id');
	}

	// A scope to tell the difference between primary and reply statuses
	public function scopeNotReply($query)
	{
		// If it doesn't have a parent_id, then it is a primary status
		return $query->whereNull('parent_id');
	}

	// Replies relationship
	public function replies()
	{
		// Each status has many replies, related by the parent_id
		return $this->hasMany('Prty\Models\Status\Status', 'parent_id');
	}
}