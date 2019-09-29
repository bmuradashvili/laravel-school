<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Teacher extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_id',
        'name',
        'email',
        'biography',
        'certified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['position_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'certified' => 'boolean',
    ];

    /**
     * Get the position of the director.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get all of the messages sent to the director.
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }

    /**
     * Get all of the comments left to the director.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
