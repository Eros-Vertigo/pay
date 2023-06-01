<?php

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\Payment;
use Pay\Exceptions\WechatException;
use Pay\Gateways\models\WechatModel;
use Pay\Processor\Parameter;

/**
 * WeChat Payment
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class WeChat extends Payment
{
    public function __construct($config, $api_url)
    {
        parent::__construct($config, $api_url);
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
     * @throws WechatException
     */
    public function beforeResponse($response)
    {
        $response = parent::beforeResponse($response);
        $result = Parameter::xmlToArray($response);
        if ($result['return_code'] != 'SUCCESS') {
            throw new WechatException($result['return_msg']);
        }
        return $result;
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
            return $this->success('', $result['code_url']);
        }
        if ($result['trade_type'] == 'MWEB') {
            return $this->success($result['return_code'], $result['mweb_url']);
        }
        return new WechatException('错误的支付方式');
    }
}