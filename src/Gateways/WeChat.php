<?php

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\Payment;
use Pay\Processor\Parameter;

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

        return is_array($res) ? $res : Parameter::xmlToArray($res);
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
}