<?php

namespace Pay\Processor;

use yii\base\InvalidArgumentException;
use yii\helpers\Json;

/**
 *
 * User: yuantong
 * Date: 2023/3/27
 * Email: <yuantong@srun.com>
 */
class Parameter
{
    /**
     * 生成微信签名
     * @param $params
     * @return array
     */
    public static function generateSignByWechat($params): array
    {
        $key = $params['key'];
        unset($params['key']);

        ksort($params);

        $query = sprintf('%s&key=%s', self::arrayToString($params), $key);
        $params['generateSign'] = strtoupper(md5($query));
        return $params;
    }

    public static function generateSignByAlipay($params): string
    {
        unset($params['private_key']);
        return self::arrayToString($params);
    }

    /**
     * @param $params
     * @return string
     * @author yt <yuantong@srun.com>
     */
    public static function arrayToString($params): string
    {
        $query = '';
        ksort($params);
        foreach ($params as $k => $v) {
            $query .= $k . '=' . $v . '&';
        }
        return rtrim($query, '&');
    }

    /**
     * 数组转XML
     * @param $arr
     * @return string
     */
    public static function arrayToXml($arr): string
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . self::arrayToXml($val) . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * XML转数组
     * @param $xml
     * @return mixed|null
     */
    public static function xmlToArray($xml)
    {
        if (!$xml) {
            throw new InvalidArgumentException('Convert To Array Error!');
        }

        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader(true);
        }

        return Json::decode(Json::encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)));
    }
}