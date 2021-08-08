<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\ResponseService;
use Illuminate\Http\Request;

class ToolDecodeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decodeData(Request $request)
    {
        try {
            $encode_data = $request->get('data_encode');

            if (null === $encode_data) {
                return response()->json(ResponseService::getError('data_encode is required'));
            }

            $data = ResponseService::decodeResponseData($encode_data);

            return response()->json(ResponseService::getSuccess(json_decode($data)));
        } catch (\Exception $exception) {
            return response()->json(ResponseService::getError($exception->getMessage()));
        }
    }
}
