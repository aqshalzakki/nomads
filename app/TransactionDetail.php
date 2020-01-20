<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;

    // for testing
    protected $guarded = [];

    public function transaction()
    {
    	return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
