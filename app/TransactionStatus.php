<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TransactionStatusTrait;

class TransactionStatus extends Model
{
    use TransactionStatusTrait;
    
    // for testing
    protected $fillable = ['name'];

    public $timestamps = false;

    public function transactions()
    {
    	return $this->hasMany(Transaction::class, 'transaction_status_id');
    }
}
