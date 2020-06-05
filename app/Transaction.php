<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TransactionStatusTrait as TransactionStatusId;

class Transaction extends Model
{
    use TransactionStatusId;
    use SoftDeletes;

    protected $guarded = [
    	'id', 'travel_package_id', 'created_at', 'updated_at', 'deleted_at'
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

    public function setStatusToPending()
    {
        $this->transaction_status_id = TransactionStatusId::$PENDING;
        $this->save();
    }

    public function setStatusToCancel()
    {
        $this->transaction_status_id = TransactionStatusId::$CANCEL;
        $this->save();
    }
}
