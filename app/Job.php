<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const CATEGORY_DEFAULT = 0;

    /**
     * Get job slug
     *
     * @return string
     */
    public function slug()
    {
        return $this->id . '/' . Str::slug($this->title);
    }
}

