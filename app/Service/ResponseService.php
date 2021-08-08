<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 8/8/21 .
 * Time: 12:11 PM .
 */

namespace App\Service;


use Illuminate\Support\Facades\Log;

class ResponseService
{
    const SUCCESS = 'success';
    const ERROR   = 'error';
    const FAIL    = 'fail';

    public static function getSuccess($data = [])
    {
        return [
            'status' => ResponseService::SUCCESS,
            'data'   => $data
        ];
    }

    public static function getError($message)
    {
        return [
            'status'  => ResponseService::ERROR,
            'message' => $message
        ];
    }

    public static function encodeResponse(\stdClass $data)
    : ?string
    {
        $secret_key = $data->token;
        $cipher     = config('app.cipher');
        $crypt      = new CryptService($secret_key, $cipher);

        return $crypt->customEncrypt(json_encode($data));
    }

    public static function decodeResponseData(string $data)
    {
        $secret_key = '59W0LNj8gh0g53Pp9Y46e3937mFItxxO';
        $cipher     = config('app.cipher');
        $crypt = new CryptService($secret_key, $cipher);

        return $crypt->customDecrypt($data);
    }
}
