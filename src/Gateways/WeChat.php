<?php

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\AbstractPayment;
use Pay\Gateways\models\WechatModel;
use Pay\Processor\Parameter;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;

/**
 * WeChat AbstractPayment
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class WeChat extends AbstractPayment
{
    const API_URL = 'https://api.mch.weixin.qq.com';

    public function __construct($config)
    {
        var_dump($config);exit;
        parent::__construct($config);
        $this->uri = self::API_URL;
        WechatModel::validateConfig($config);
    }

    protected function beforeRequest()
    {
        $params = array_merge($this->config, $this->payload);
        $params = Parameter::generateSignByWechat($params);
        $xml = Parameter::arrayToXml($params);
        $this->payload = ['body' => $xml];
        parent::beforeRequest();
    }

    /**
     * @param $response
     * @return InvalidConfigException
     * @author yt <yuantong@srun.com>
     */
    protected function beforeResponse($response)
    {
        $response = parent::beforeResponse($response);
        $result = Parameter::xmlToArray($response);
        if ($result['return_code'] != 'SUCCESS') {
            throw new InvalidCallException($result['return_msg']);
        }
        return $this->parseResponse($result);
    }

    /**
     * @throws GuzzleException
     */
    public function web($params): string
    {
        $this->uri = sprintf('%s/pay/%s', $this->uri, 'unifiedorder');
        $this->payload = array_merge($params, ['trade_type' => 'NATIVE', 'spbill_create_ip' => \Yii::$app->request->userIP]);
        return $this->post();
    }

    /**
     * @throws GuzzleException
     */
    public function wap($params): string
    {
        $this->uri = sprintf('%s/pay/%s', $this->uri, 'unifiedorder');
        $this->payload = array_merge($params, ['trade_type' => 'MWEB', 'spbill_create_ip' => \Yii::$app->request->userIP]);
        return $this->post();
    }

    /**
     * @throws GuzzleException
     */
    public function query($out_trade_no): string
    {
        $this->uri = sprintf('%s/pay/%s', $this->uri, 'orderquery');
        $this->payload = compact('out_trade_no');
        return $this->post();
    }

    /**
     * 格式化响应
     * @param $result
     * @return InvalidConfigException
     */
    public function parseResponse($result): InvalidConfigException
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