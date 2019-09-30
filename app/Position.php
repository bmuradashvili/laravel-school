<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     description="Position model",
 *     title="Position model",
 *     required={"name"},
 *     @OA\Xml(
 *         name="Position"
 *     )
 * )
 */
class Position extends Model
{
    /**
     * @OA\Property(
     *     format="int",
     *     description="ID",
     *     title="ID",
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="name",
     *     title="Name",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * Validation rules for model creation
     *
     * @static
     */
    public static $createRules = [
        'name' => 'required|unique:positions,name|max:255',
    ];

    /**
     * Validation rules for model updating
     *
     * @static
     */
    public static $updateRules = [
        'id' => 'required|integer|exists:positions,id',
        'name' => 'required|unique:positions,name|max:255',
    ];

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
