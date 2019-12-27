<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    // for testing only
    // protected $guarded = [
    // 	'id'
    // ];

    // for production
    protected $guarded = [
    	'id', 'travel_package_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * define a relationship with transaction status model
     *
     * @return instance of transaction within the status
     * @author aqshalzakki
     **/
    public function status()
    {
        return $this->belongsTo(TransactionStatus::class, 'transaction_status_id');
    } 

    /**
     * define a relationship with transaction detail model
     *
     * @return instance of transaction within all of details
     * @author aqshalzakki
     **/
    public function details()
    {
    	return $this->hasMany(TransactionDetail::class);
    }

    /**
     * define a relationship with travel package model
     *
     * @return instance of transaction within the travel package
     * @author aqshalzakki
     **/
    public function travel_package()
    {
    	return $this->belongsTo(TravelPackage::class);
    }

    /**
     * define a relationship with user model
     *
     * @return instance of transaction within the user
     * @author aqshalzakki
     **/
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function withRelationships()
    {
        return $this->with([
            'details', 'travel_package', 'user', 'status'
        ])->get();
    }
}
