<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CarbonFootprint extends Model
{
	protected $table = 'carbon_footprints';
	public $timestamps = true;

	protected $fillable = [
		'activity', 'activity_type', 'country', 'mode', 'carbon_footprint'
	];
}
