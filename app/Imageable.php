<?php

namespace App;

use App\Image;

trait Imageable
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
