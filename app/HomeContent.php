<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $table = 'home_content';
	public $timestamps = false;

	public function scopeGetAllActiveContents($query) {
		return $query->where('active', 1);
	}

	public function scopeGetAllNonActiveContents($query) {
		return $query->where('active', 0);
	}

	public function scopeGetContent($query, $id) {
		return $query->where('id', $id);
	}
}
