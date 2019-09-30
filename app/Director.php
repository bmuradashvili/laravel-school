<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @OA\Schema(
 *     description="Director model",
 *     title="Director model",
 *     required={"position", "name", "email", "phone", "biography", "thumbnail"},
 *     @OA\Xml(
 *         name="Director"
 *     )
 * )
 */
class Director extends Model implements HasMedia
{
    use HasMediaTrait;

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
     *     property="position",
     *     type="object",
     *     ref="#/components/schemas/Position"
     * )
     *
     * @var Position
     */
    private $position;

    /**
     * @OA\Property(
     *     format="string",
     *     description="Name",
     *     title="Name",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     format="string",
     *     description="Email",
     *     title="Email",
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     format="string",
     *     description="phone",
     *     title="Phone Number",
     * )
     *
     * @var string
     */
    private $phone;

    /**
     * @OA\Property(
     *     format="string",
     *     description="biography",
     *     title="Biography",
     * )
     *
     * @var string
     */
    private $biography;

    /**
     * @OA\Property(
     *     type="string",
     *     format="binary",
     *     description="thumbnail",
     *     title="Thumbnail",
     * )
     *
     * @var string
     */
    private $thumbnail;

    /**
     * Validation rules for model creation
     *
     * @static
     */
    public static $createRules = [
        'position_id' => 'required|integer|exists:positions,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string',
        'biography' => 'required|string|max:65535',
        'thumbnail' => 'required|image|size:4096'
    ];

    /**
     * Validation rules for model updating
     *
     * @static
     */
    public static $updateRules = [
        'id' => 'required|exists:directors,id',
        'position_id' => 'required|integer|exists:positions,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string',
        'biography' => 'required|string|max:65535',
        'thumbnail' => 'required|image|size:4096'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_id',
        'name',
        'email',
        'phone',
        'biography'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['position_id'];

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
