<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phoneNum', 'country', 'description', 'language', 'skills', 'education', 'cert'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user may create many Jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * A user may apply for many jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function appliedJobs()
    {
        return $this->belongsToMany(Job::class, 'job_user', 'user_id', 'job_id')->withTimestamps();
    }

    /**
     * A user has many messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Check if user has applied for the job.
     * Todo: Test
     * @param Job $job
     * @return bool
     */
    public function hasAppliedJob(Job $job)
    {
        return $this->appliedJobs()->where('job_id', $job->id)->exists();
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
