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

    public function handlePaymentGateway()
    {
        Config::$serverKey    = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized  = config('midtrans.isSanitized');
        Config::$is3ds        = config('midtrans.is3ds');

        // prepare data for midtrans
        $data = [
            'transaction_detail' => [
                'order_id'     => 'NOMADS-' . $this->id,
                'gross_amount' => (int) $this->total,
            ],
            'customer_detail' => [
                'first_name' => $this->user->name,
                'email'      => $this->user->email,
            ],
            'enabled_payments' => ['gopay'],
            'vtweb' => []
        ];

        try {
            // get url
            $paymentUrl = Snap::createTransaction($data)->redirect_url;

            // redirect to midtrans
            header('Location: ' . $paymentUrl);
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
