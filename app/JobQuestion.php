<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    protected $fillable = ['title', 'description', 'attributes'];

    protected $table = 'job_questions';

    /**
     * A question is belongs to a Job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
