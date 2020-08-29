<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
	public $timestamps = false;
	protected $fillable = [
    'label', 'link'
	];

	public function scopeGetAllActiveImages($query) {
		return $query->select('images.label', 'images.link');
	}

	public function scopeGetActiveImageFor($query, $page) {
		return $query->select('images.label', 'images.link')
					 ->join('pages', 'pages.id', '=' , 'images.page')
					 ->where('pages.label', '=', $page);
	}

	public function scopeGetImage($query, $label) {
		return $query->where('label', $label);
	} 
}
