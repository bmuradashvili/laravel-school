<?php

namespace App\Http\Controllers\Api;

use App\Director;
use Illuminate\Http\Request;
use App\Http\Resources\DirectorCollection;

class DirectorController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/directors",
     *   operationId="index",
     *   tags={"Directors"},
     *   summary="Get list of directors",
     *   description="Get directors service",
     *   @OA\Parameter(
     *     name="page",
     *     in="query",
     *     required=false,
     *     @OA\Schema(type="int")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Array of directors", type="array",
     *         @OA\Items(ref="#/components/schemas/Director")
     *       ),
     *       @OA\Property(property="links", description="Pagination urls", type="object",
     *         @OA\Property(property="first", description="First page url", type="string"),
     *         @OA\Property(property="last", description="Last page url", type="string"),
     *         @OA\Property(property="prev", description="Previous page url", type="string"),
     *         @OA\Property(property="next", description="Next page url", type="string"),
     *       ),
     *       @OA\Property(property="meta", description="Pagination meta data", type="object",
     *         @OA\Property(property="current_page", description="Number of the current page", type="integer"),
     *         @OA\Property(property="from", description="Number of the displayed first item in the whole paginated list", type="integer"),
     *         @OA\Property(property="last_page", description="Last page number", type="integer"),
     *         @OA\Property(property="path", description="Full url of the called service", type="string"),
     *         @OA\Property(property="per_page", description="Items per page", type="string"),
     *         @OA\Property(property="to", description="Number of the displayed last item in the whole paginated list", type="integer"),
     *         @OA\Property(property="total", description="Number of total records in the paginated list", type="integer"),
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
     * Returns list of directors
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return new DirectorCollection(Director::with('media')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
