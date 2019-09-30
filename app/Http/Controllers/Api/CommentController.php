<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *   path="/api/comments",
     *   operationId="store",
     *   tags={"Comments"},
     *   summary="Insert new comment",
     *   description="Store new comment service",
     *   @OA\RequestBody(
     *     description="Comment object",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(property="commentable_type", description="App\Director or App\Teacher", type="string"),
     *         @OA\Property(property="commentable_id", description="ID of the according(Director/Teacher) model", type="integer"),
     *         @OA\Property(property="rating", description="Rating (1-5)", type="int"),
     *         @OA\Property(property="text", description="Comment text", type="string"),
     *         @OA\Property(property="image", description="Attached image", type="string", format="binary"),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Comment object", type="object",
     *         @OA\Property(property="id", description="Comment ID", type="integer"),
     *         @OA\Property(property="user", description="User object", type="object", ref="#/components/schemas/User"),
     *         @OA\Property(property="to", description="Director or Teacher model", type="object",
     *           @OA\Schema(type="object", oneOf=@OA\Items(ref="#/components/schemas/Director", ref="#/components/schemas/Teacher"))
     *         ),
     *         @OA\Property(property="rating", description="Rating (1-5)", type="integer"),
     *         @OA\Property(property="text", description="Comment Text", type="string"),
     *         @OA\Property(property="image", description="Image url", type="string"),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Unprocessable Entity",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="message", description="Error message", type="string"),
     *       @OA\Property(property="errors", description="Errors object for more details", type="object",
     *         @OA\Property(property="commentable_type", description="commentable_type error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="commentable_id", description="commentable_id error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="rating", description="rating error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="text", description="comment text error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="image", description="image error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="error", description="Error message", type="string")
     *     ),
     *   ),
     *   security={
     *     {"authToken": {}}
     *   }
     * )
     *
     * Store a newly created resource in storage
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $commentData = $request->validated();
        $commentData['user_id'] = auth()->user()->id;

        $newComment = Comment::create($commentData);

        if ($request->hasFile('image')) {
            $newComment->addMedia($request->file('image'))->toMediaCollection('comment_images');
        }

        return $this->success(new CommentResource(Comment::with('media')->find($newComment->id)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
