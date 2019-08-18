<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobAnswer extends Model
{
    protected $fillable = ['answers'];

    /**
     * Answer belongs to a question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\JobQuestion');
    }
}
