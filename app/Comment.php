<?php

namespace App;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @OA\Schema(
 *     description="Comment model",
 *     title="Comment model",
 *     required={"user", "text"},
 *     @OA\Xml(
 *         name="Comment"
 *     )
 * )
 */
class Comment extends Model implements HasMedia
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
     *     property="user",
     *     type="object",
     *     ref="#/components/schemas/User"
     * )
     *
     * @var User
     */
    private $user;

    /**
     * @OA\Property(
     *     format="int",
     *     description="rating (1-5)",
     *     title="Rating",
     * )
     *
     * @var integer
     */
    private $rating;

    /**
     * @OA\Property(
     *     format="string",
     *     description="text",
     *     title="Text",
     * )
     *
     * @var string
     */
    private $text;

    /**
     * @OA\Property(
     *     type="string",
     *     format="binary",
     *     description="image",
     *     title="Image",
     * )
     *
     * @var string
     */
    private $image;

    /**
     * Validation rules for model creation
     *
     * @static
     */
    public static $createRules = [
        'commentable_type' => 'required|in:App\Director,App\Teacher',
        'commentable_id' => 'required|poly_exists:commentable_type',
        'rating' => 'sometimes|required|integer|between:1,5',
        'text' => 'required|max:65535',
        'image' => 'sometimes|required|image|between:0,4096'
    ];

    /**
     * Validation rules for model updating
     *
     * @static
     */
    public static $updateRules = [
        'id' => 'required|exists:comments,id',
        'rating' => 'sometimes|required|integer|between:1,5',
        'text' => 'required|max:65535',
        'image' => 'sometimes|required|image|between:0,4096'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'rating',
        'text',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'commentable_id',
        'commentable_type',
    ];

    /**
     * Get the user(sender) of the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
