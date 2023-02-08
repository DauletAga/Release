<?php

namespace App\Http\Controllers;

use App\Contracts\StorageContract;
use App\Utilities\ResponseUtilities;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function changeIsShow(Request $request, $model_name){

        $model_name = '\App\Models\\' . $model_name;
        $row = $model_name::findOrFail($request->id);

        $status = $row->update(['is_show'=> $request->is_show]);

        if(isset($row->parent_id))
            $model_name::updateChildCount($row->parent_id);

        return $status?$this->sendSuccess():$this->sendError();
    }

    public function restore(Request $request, $model_name){
        $model_name = '\App\Models\\' . $model_name;
        $row = $model_name::withTrashed()->findOrFail($request->id);

        $status = $row->restore();

        if(isset($row->parent_id))
            $model_name::updateChildCount($row->parent_id);

        return $status?$this->sendSuccess():$this->sendError();
    }

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

    public function sendSuccess(string $message = null,array $result = []): JsonResponse
    {
        $result['status'] = true;
        $result['message'] = $message ?? 'Успешный сохранено';
        return response()->json($result);
    }

    /**
     * @param $error
     * @param  array  $data
     * @param  int  $code
     *
     * @return JsonResponse
     */
    public function sendError($error = null, int $code = 422, array $data = []): JsonResponse
    {
        $result['status'] = false;
        $result['error'] = $error ?? 'Ошибка';
        $result['error_list'] = $data;
        return response()->json($result,$code);
    }

    public function sendErrorValidator($validator): JsonResponse
    {
        $result['status'] = false;
        $result['error'] = $validator->errors()->all()[0];
        $result['error_list'] = $validator->errors()->all();
        return response()->json($result,200);
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
