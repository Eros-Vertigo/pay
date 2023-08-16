<?php

namespace Pay\Processor;

use yii\base\InvalidConfigException;

/**
 *
 * User: yuantong
 * Date: 2023/3/30
 * Email: <yuantong@srun.com>
 */
class Encryptor
{
    /**
     * RSA2加密
     * @param $data
     * @param $private_key
     * @return string|void
     * @throws InvalidConfigException
     * @author yt <yuantong@srun.com>
     */
    public static function generateSign($data, $private_key)
    {
        if (is_null($private_key)) {
            throw new InvalidConfigException("Missing Alipay Config -- [private_key]");
        }

        if (self::endsWith($private_key, '.pem')) {
            $res = openssl_pkey_get_private($private_key);
        } else {
            $pem_key = "-----BEGIN PRIVATE KEY-----\n" . chunk_split($private_key, 64, "\n") . "-----END PRIVATE KEY-----";
            $res = openssl_get_privatekey($pem_key);
        }

        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');

        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);

        if (is_resource($res)) {
            openssl_free_key($res);
        }
        return base64_encode($sign);
    }

    /**
     * 签名验证
     * @param $data
     * @param $sign
     * @param $public_key
     * @return bool
     * @throws InvalidConfigException
     */
    public static function verify($data, $sign, $public_key): bool
    {
        if (is_null($public_key)) {
            throw new InvalidConfigException("Missing Alipay Config -- [ali_public_key]");
        }

        if (self::endsWith($public_key, '.crt')) {
            $publicKey = file_get_contents($public_key);
        } elseif (self::endsWith($public_key, '.pem')) {
            $publicKey = openssl_pkey_get_public($public_key);
        } else {
            $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($public_key, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }

        if (!$publicKey) {
            throw new InvalidConfigException("公钥解析错误，请检查公钥配置");
        }

        $isVerify = 1 == openssl_verify($data, base64_decode($sign), $publicKey, OPENSSL_ALGO_SHA256);

        if (is_resource($publicKey)) {
            openssl_free_key($publicKey);
        }

        return $isVerify;
    }

    public static function endsWith(string $haystack, $needles): bool
    {
        foreach ((array)$needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string)$needle) {
                return true;
            }
        }
        return false;
    }
}