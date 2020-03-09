<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Midtrans\Config;
use Midtrans\Snap;

class Transaction extends Model
{
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

    public function handlePayment()
    {
        $this->setMidtransConfiguration();
        $data = [
            'transaction_details' => [
                'order_id' => 'NOMADS-' . $this->id,
                'gross_amount' => (int) $this->total,
            ],
            'customer_details' => [
                'first_name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'enabled_payments' => ['gopay'],
            'vtweb' => []
        ];
        try {
            // Url redirect
            $redirectUrl = Snap::createTransaction($data)->redirect_url;
            // redirect user to payment page
            return $redirectUrl;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function setMidtransConfiguration()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }
}
