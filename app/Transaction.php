<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    // for testing 
    protected $guarded = [
    	'id'
    ];

    // for real
    // protected $guarded = [
    // 	'id', 'travel_package_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'
    // ];

    public function status()
    {
        return $this->belongsTo(TransactionStatus::class, 'transaction_status_id');
    }    

    public function details()
    {
    	return $this->hasMany(TransactionDetail::class);
    }

    public function travel_package()
    {
    	return $this->belongsTo(TravelPackage::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
