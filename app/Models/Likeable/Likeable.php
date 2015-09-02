<?php

// Likeable.php
// A model for making any item likeable/votable

namespace Prty\Models\Likeable;

use Illuminate\Database\Eloquent\Model;

class Likeable extends Model
{
	protected $table = 'likeable';

	public function likeable()
	{
		// Return polymorphic relationship - applied to any other model!
		return $this->morphTo();
	}

	// Relates a user
	public function user()
	{
		return $this->belongsTo('Prty\Models\User\User', 'user_id');
	}
}