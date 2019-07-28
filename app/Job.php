<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

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

    /**
     * A job is belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return price in currency friendly format.
     *
     * @return float|int
     */
    public function priceInCurrency()
    {
        return number_format($this->price / 100, 2);
    }

    /**
     * Return true if authenticated user is job owner.
     *
     * @return bool
     */
    public function isOwner()
    {
        if(Auth::guest()) return false;

        return $this->isOwnedBy(Auth::user());
    }

    /**
     * Return true if user is job owner.
     *
     * @param User $user
     * @return bool
     */
    public function isOwnedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * Return description excerpt.
     *
     * @return string
     */
    public function excerpt()
    {
        return Str::words($this->description,10);
    }

    /**
     * Query scope find job by title.
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public static function scopeByTitleContains($query, $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }
}

