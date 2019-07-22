<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['title', 'description', 'price'];

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

