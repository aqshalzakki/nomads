<?php

namespace App\Traits;

trait TransactionStatusTrait
{
    public static $IN_CART = 1;
    public static $PENDING = 2;
    public static $SUCCESS = 3;
    public static $CANCEL  = 4;
    public static $FAILED  = 5;
}