<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    // for testing
    protected $fillable = ['name'];

    public $timestamps = false;

    public function transactions()
    {
    	return $this->hasMany(Transaction::class, 'transaction_status_id');
    }
}
