<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 8/8/21 .
 * Time: 12:16 PM .
 */

namespace App\Service;


use Illuminate\Encryption\Encrypter;

class CryptService
{
    private $newEncrypter;

    public function __construct($customKey, $cipher)
    {
        $this->newEncrypter = new Encrypter($customKey, $cipher);
    }

    function customEncrypt($vWord){
        return $this->newEncrypter->encrypt($vWord);
    }

    function customDecrypt($vWord){
        return $this->newEncrypter->decrypt($vWord);
    }

    public static function decodeData(string $data, $secret_key, $type = 128)
    {
        $cipher = config('common.cipher-'.$type);
        $crypt = new CryptService($secret_key, $cipher);

        return $crypt->customDecrypt($data);
    }
}
