<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'seller_rate', 'buyer_rate'
    ];

    protected $table = 'rating';

    /**
     * A user can have many ratings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
