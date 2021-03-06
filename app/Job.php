<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes, Imageable;

    protected $appends = ['slug'];
    protected $fillable = ['title', 'description', 'price', 'status', 'expected_delivery_date'];

    const CATEGORY_DEFAULT = 0;

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED = 3;

    const STATUS_APPLICANT_NOT_HIRED = 0;
    const STATUS_APPLICANT_HIRED = 1;

    const STATUS_TYPE = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_PUBLISHED => 'Published',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PUBLISHED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED
    ];

    /**
     * Get job slug.
     *
     * @return string
     */
    public function slug()
    {
        return $this->id . '/' . Str::slug($this->title);
    }

    /**
     * Append slug to object property.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return self::slug();
    }

    public function getDefaultImage()
    {
        if($this->images()->first() != null) {
            return Storage::url($this->images()->first()->path);
        } else {
            return 'https://placehold.co/600x400';
        }
    }

    /**
     * Get job slug with prefix.
     * Todo: Unit Test.
     * @return string
     */
    public function slugWithPrefix()
    {
        return 'jobs/' . $this->id . '/' . Str::slug($this->title);
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
     * A job has many applicants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function applicants()
    {
        return $this->belongsToMany(User::class, 'job_user')->withTimestamps();
    }

    /**
     * Job has many question for applicants to be answered.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(JobQuestion::class, 'job_id');
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

    public static function getStatuses()
    {
        return self::STATUSES;
    }

    /**
     * Get published job.
     *
     * @param $query
     * @return mixed
     */
    public static function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)->with('author')->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Returns true if job is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->status == Job::STATUS_PUBLISHED;
    }
}

