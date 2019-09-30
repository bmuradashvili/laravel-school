<?php

namespace App\Http\Controllers\Api;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherCollection;

class TeacherController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/teachers",
     *   operationId="index",
     *   tags={"Teachers"},
     *   summary="Get list of teachers",
     *   description="Get teachers service",
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
     *       @OA\Property(property="data", description="Array of teachers", type="array",
     *         @OA\Items(ref="#/components/schemas/Teacher")
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
     * Returns list of teachers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return new TeacherCollection(Teacher::with('media')->paginate(20));
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
