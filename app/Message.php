<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Message extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'messageable_id',
        'messageable_type',
        'text',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'messageable_id',
        'messageable_type',
    ];

    /**
     * Get the user(sender) of the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owning messageable model.
     */
    public function messageable()
    {
        return $this->morphTo();
    }
}
