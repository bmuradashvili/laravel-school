<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var object|array $data
     * @var int $responseCode
     */
    protected function success($data, int $responseCode = 200)
    {
        return response()->json(['data' => $data], $responseCode);
    }

    /**
     * @var object|array $data
     * @var int $responseCode
     */
    protected function fail($data, int $responseCode = 400)
    {
        return response()->json(['errors' => $data], $responseCode);
    }

    /**
     * @var string $message
     * @var int $responseCode
     */
    protected function error(string $message, int $responseCode = 400)
    {
        return response()->json(['error' => $message], $responseCode);
    }
}
