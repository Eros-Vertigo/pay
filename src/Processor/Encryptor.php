<?php

namespace Pay\Processor;

/**
 *
 * User: yuantong
 * Date: 2023/3/30
 * Email: <yuantong@srun.com>
 */
class Encryptor
{
    public static function sign($data, $private_key)
    {
        $pem_key = "-----BEGIN PRIVATE KEY-----\n" . chunk_split($private_key, 64, "\n") . "-----END PRIVATE KEY-----";
        $res = openssl_get_privatekey($pem_key);

        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');

        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);

        return base64_encode($sign);
    }
}