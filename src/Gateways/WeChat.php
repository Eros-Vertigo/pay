<?php

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\Payment;
use Pay\Exceptions\WechatException;
use Pay\Gateways\models\WechatModel;
use Pay\Processor\Parameter;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;

/**
 * WeChat Payment
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class WeChat extends Payment
{
    const API_URL = 'https://api.mch.weixin.qq.com';
    public function __construct($config)
    {
        parent::__construct($config);
        $this->api_url = self::API_URL;
        WechatModel::validateConfig($config);
    }

    public function beforeRequest()
    {
        $params = array_merge($this->config, $this->payload);
        $params = Parameter::generateSignByWechat($params);
        $xml = Parameter::arrayToXml($params);
        $this->payload = ['body' => $xml];
        parent::beforeRequest();
    }

    /**
     * @param $response
     * @return mixed|InvalidConfigException
     * @throws BadRequestHttpException
     * @author yt <yuantong@srun.com>
     */
    public function beforeResponse($response)
    {
        $response = parent::beforeResponse($response);
        $result = Parameter::xmlToArray($response);
        if ($result['return_code'] != 'SUCCESS') {
            throw new BadRequestHttpException($result['return_msg']);
        }
        return $this->parseResponse($result);
    }

    /**
     * @throws GuzzleException
     */
    public function createOrder($params)
    {
        $this->uri = sprintf('%s/pay/%s', $this->api_url, 'unifiedorder');
        $this->payload = $params;
        return $this->post();
    }


    /**
     * @throws GuzzleException
     */
    public function query($out_trade_no)
    {
        $this->uri = sprintf('%s/pay/%s', $this->api_url, 'orderquery');
        $this->payload = compact('out_trade_no');
        return $this->post();
    }

    public function parseResponse($result)
    {
        if ($result['trade_type'] == 'NATIVE') {
            // 扫码
            return $result['code_url'];
        }
        if ($result['trade_type'] == 'MWEB') {
            return $result['mweb_url'];
        }
        return new InvalidConfigException('错误的支付方式');
    }
}