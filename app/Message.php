<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     description="Message model",
 *     title="Message model",
 *     required={"user", "text"},
 *     @OA\Xml(
 *         name="Message"
 *     )
 * )
 */
class Message extends Model
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
     *     format="string",
     *     description="text",
     *     title="Text",
     * )
     *
     * @var string
     */
    private $text;

    /**
     * Validation rules for model creation
     *
     * @static
     */
    public static $createRules = [
        'messageable_type' => 'required|in:App\Director,App\Teacher',
        'messageable_id' => 'required|integer|poly_exists:messageable_type',
        'text' => 'required|max:65535',
    ];

    /**
     * Validation rules for model updating
     *
     * @static
     */
    public static $updateRules = [
        'id' => 'required|integer|exists:messages,id',
        'text' => 'required|max:65535',
    ];

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
