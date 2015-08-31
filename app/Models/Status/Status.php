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
}