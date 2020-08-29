<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetup extends Model
{
    protected $table = 'site_setup';
	public $timestamps = false;
	protected $fillable = [
    'label', 'content'
	];

	public function scopeGetAllSiteSetup($query) {
		return $query->select('label', 'content');
	}

	public function scopeGetSiteSetupFor($query, $label) {
		return $query->where('label', $label);
	}

	public function scopeGetSiteSetup($query, $id) {
		return $query->where('id', $id);
	}
}
