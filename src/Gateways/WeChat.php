<?php

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\Payment;
use Pay\Exceptions\WechatException;
use Pay\Processor\Parameter;
use yii\helpers\Json;

/**
 * WeChat Payment
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class WeChat extends Payment
{
    /**
     * @throws GuzzleException
     */
    private function requestApi($payload, $method)
    {
        $params = array_merge($this->config, $payload);
        $params = Parameter::generateSignByWechat($params);
        $xml = Parameter::arrayToXml($params);

        $res = $this->post(sprintf('%s/pay/%s', $this->api_url, $method), [
            'body' => $xml,
        ]);

        $result = Parameter::xmlToArray($res);
        if ($result['return_code'] != 'SUCCESS') {
            return new WechatException($result['return_msg']);
        }
        return $result;
    }
    /**
     * @throws GuzzleException
     */
    public function createOrder($params)
    {
        return $this->requestApi($params, 'unifiedorder');
    }


    /**
     * @throws GuzzleException
     */
    public function query($out_trade_no)
    {
        return $this->requestApi(compact('out_trade_no'), 'orderquery');
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