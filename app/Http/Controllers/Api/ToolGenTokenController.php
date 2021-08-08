<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\ResponseService;
use Illuminate\Http\Request;

class ToolGenTokenController extends Controller
{
    public function genToken(Request $request)
    {
        try{
            $data = (object)[
                'X-Network-Id' => $request->network_id,
                'X-Port-Type' => $request->type,
                'X-Request-Time' => $request->time,
                'token' => $request->token
            ];
            $token = ResponseService::encodeResponse($data);
            return response()->json(ResponseService::getSuccess($token));
        }catch (\Exception $exception)
        {
            return response()->json(ResponseService::getError($exception->getMessage()));
        }
    }
}
