<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
	use HasFactory;

	protected static function booted()
	{
		static::creating(function ($contact) {
			$contact->user_id = Auth::id();
		});
	}

	protected $fillable = [
		'user_id', 'name', 'company', 'phone', 'email'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function scopeMyContact($query)
	{
		return $query->where("user_id", Auth::id());
	}
}
