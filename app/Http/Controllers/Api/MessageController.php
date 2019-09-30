<?php

namespace App\Http\Controllers\Api;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\Message as MessageResource;

class MessageController extends Controller
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
     *   path="/api/messages",
     *   operationId="store",
     *   tags={"Messages"},
     *   summary="Insert new message",
     *   description="Store new message service",
     *   @OA\RequestBody(
     *     description="Message object",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(property="messageable_type", description="App\Director or App\Teacher", type="string"),
     *         @OA\Property(property="messageable_id", description="ID of the according(Director/Teacher) model", type="integer"),
     *         @OA\Property(property="text", description="Message text", type="string"),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Message object", type="object",
     *         @OA\Property(property="id", description="Message ID", type="integer"),
     *         @OA\Property(property="user", description="User object", type="object", ref="#/components/schemas/User"),
     *         @OA\Property(property="to", description="Director or Teacher model", type="object",
     *           @OA\Schema(type="object", oneOf=@OA\Items(ref="#/components/schemas/Director", ref="#/components/schemas/Teacher"))
     *         ),
     *         @OA\Property(property="text", description="Message Text", type="string"),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Unprocessable Entity",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="message", description="Error message", type="string"),
     *       @OA\Property(property="errors", description="Errors object for more details", type="object",
     *         @OA\Property(property="messageable_type", description="messageable_type error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="messageable_id", description="messageable_id error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="text", description="message text error messages", type="array",
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
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMessageRequest $request)
    {
        $messageData = $request->validated();
        $messageData['user_id'] = auth()->user()->id;

        $newMessage = Message::create($messageData);

        return $this->success(new MessageResource($newMessage));
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
