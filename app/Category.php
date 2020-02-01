<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $guarded = [];

	public function travel_packages()
	{
		return $this->hasMany(TravelPackage::class);
	}

	public function isSelected($category)
	{
		return $category->id == $this->id;
	}

	public function resolveRouteBinding($value)
	{
	    return $this->where('title', $value)->firstOrFail();
	}
}
