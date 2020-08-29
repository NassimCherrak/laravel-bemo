<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    public $timestamps = false;

	public function scopeGetAllActivePages($query) {
		return $query->where('active', 1);
	}

	public function scopeGetPage($query, $label) {
		return $query->where('label', $label);
	}
}
