<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['job_id', 'seller_id', 'buyer_id', 'seller_rate', 'buyer_rate'];
}
