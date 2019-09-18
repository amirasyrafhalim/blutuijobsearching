<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Document extends Model
{
    use Notifiable;

    protected $fillable = [
        'title', 'description', 'path_url', 'verified_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
