<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveImage extends Model
{
    protected $table = 'active_image';
	public $timestamps = false;

	public function scopeGetCurrentActiveImageFor($query, $page) {
		return $query->select('images.id', 'images.label', 'images.link')->join('images', 'images.id', '=', 'active_image.image')->join('pages', 'pages.id', '=', 'active_image.page')->where('pages.label', $page);
	}

	public function scopeGetActiveImage($query, $id) {
		return $query->where('id', $id);
	}

	public function scopeGetActiveImageForPage($query, $page) {
		return $query->where('page', $page);
	}
}
