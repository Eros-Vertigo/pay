<?php
/**
 * 支付宝支付网关
 * User: yuantong
 * Date: 2023/3/24
 * Email: <yuantong@srun.com>
 */

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\Payment;
use Pay\Gateways\models\AlipayModel;
use Pay\Processor\Encryptor;
use Pay\Processor\Parameter;
use yii\helpers\Json;

class AliPay extends Payment
{
    const API_URL = 'https://openapi.alipay.com/gateway.do';
    const PRODUCT_CODE = 'FAST_INSTANT_TRADE_PAY';
    /**
     * @var string 请求方法
     */
    private string $method = 'alipay.trade.page.pay';

    public function __construct($config)
    {
        parent::__construct($config);
        $this->api_url = self::API_URL;
        AlipayModel::validateConfig($config);
    }

    public function beforeRequest()
    {
        $params = $this->payload;
        $params = array_merge($this->config, [
            'method' => $this->method,
            'timestamp' => date('Y-m-d H:i:s'),
            'bizcontent' => Json::encode($params)
        ]);
        $data = Parameter::generateSignByAlipay($params);
        $sign = Encryptor::sign($data, $this->config['private_key']);
        $params['sign'] = $sign;
        unset($params['private_key']);
        $this->payload = [
            'form_params' => $params,
            'decode_content' => 'gzip', // 设置响应解码方式为 gzip，提高响应速度
            'headers' => [
                'Accept-Encoding' => 'gzip', // 告诉服务器可以返回 gzip 压缩的响应
            ],
        ];
    }

    public function beforeResponse($response)
    {
        $response = parent::beforeResponse($response);
        return iconv('GBK', 'UTF-8//IGNORE', $response);
    }

    /**
     * @throws \Exception
     * @throws GuzzleException
     */
    public function createOrder($params)
    {
        $this->payload = $params;
        $this->uri = $this->api_url;
        return $this->post();
    }

    public function query($out_trade_no)
    {

    }
}