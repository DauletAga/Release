<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Utilities\ResponseUtilities;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AppBaseController extends Controller
{
    /**
     * @param $result
     * @param  null  $message
     *
     * @return JsonResponse
     */
    public function sendResponse($result, $message = null): JsonResponse
    {
        return response()->json(ResponseUtilities::makeResponse(
            $message, $result
        ));
    }

    /**
     * @param  string|null  $message
     *
     * @return JsonResponse
     */
    public function sendSuccess(string $message = null): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('general.success'),
        ]);
    }

    /**
     * @param $error
     * @param  array  $data
     * @param  int  $code
     *
     * @return JsonResponse
     */
    public function sendError(
        $error,
        int $code = Response::HTTP_NOT_FOUND,
        array $data = []
    ): JsonResponse {
        return response()->json(
            ResponseUtilities::makeError($error, $data),
            $code
        );
    }

    /**
     * @param $token
     *
     * @return JsonResponse
     */
    public function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard()->factory()->getTTL() * 60
        ]);
    }
}
