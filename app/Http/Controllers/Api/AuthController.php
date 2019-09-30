<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *   path="/api/auth/login",
     *   operationId="login",
     *   tags={"Auth"},
     *   summary="Authenticate user",
     *   description="User authorization service",
     *   @OA\RequestBody(
     *     description="Email and password values",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(property="email", description="User email", type="string"),
     *         @OA\Property(property="password", description="User password", type="string")
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Data object", type="object",
     *         @OA\Property(property="access_token", description="auth token", type="string"),
     *         @OA\Property(property="token_type", description="token type", type="string"),
     *         @OA\Property(property="expires_in", description="expires in seconds", type="integer"),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Unprocessable Entity",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="message", description="Error message", type="string"),
     *       @OA\Property(property="errors", description="Errors object for more details", type="object",
     *         @OA\Property(property="email", description="email error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *         @OA\Property(property="password", description="password error messages", type="array",
     *           @OA\Items(type="string")
     *         ),
     *       ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Invalid credentials",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="error", description="Error message", type="string")
     *     ),
     *   ),
     * )
     *
     * Returns authorization info
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return $this->error("Invalid credentials", 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *   path="/api/auth/user",
     *   operationId="user",
     *   tags={"Auth"},
     *   summary="Get authenticated user",
     *   description="Returns user object",
     *   @OA\Header(
     *     header="bearerAuth",
     *     description="JWT access token",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Response data", type="object", ref="#/components/schemas/User")
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
     * Returns serialized user object
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return $this->success(new UserResource(auth()->user()));
    }

    /**
     * @OA\Post(
     *   path="/api/auth/logout",
     *   operationId="logout",
     *   tags={"Auth"},
     *   summary="Logout",
     *   description="Logs out a user",
     *   @OA\Header(
     *     header="bearerAuth",
     *     description="JWT access token",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Data object", type="object",
     *         @OA\Property(property="message", description="success message", type="string"),
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
     * Returns serialized user object
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->success(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Post(
     *   path="/api/auth/refresh",
     *   operationId="refresh",
     *   tags={"Auth"},
     *   summary="Refresh acccess token",
     *   description="Expired access token refresh service",
     *   @OA\Header(
     *     header="bearerAuth",
     *     description="JWT access token",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="data", description="Data object", type="object",
     *         @OA\Property(property="access_token", description="auth token", type="string"),
     *         @OA\Property(property="token_type", description="token type", type="string"),
     *         @OA\Property(property="expires_in", description="expires in seconds", type="integer"),
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
     * Returns refreshed authorization info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
