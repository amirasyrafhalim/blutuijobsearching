<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'is_default'];

    const DEFAULT_IMAGE = 1;

    public function imageable()
    {
        return $this->morphTo();
    }
}
