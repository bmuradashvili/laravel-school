<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the directors for this position.
     */
    public function directors()
    {
        return $this->hasMany(Director::class);
    }

    /**
     * Get the teachers for this position.
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
