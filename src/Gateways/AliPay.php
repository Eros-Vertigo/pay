<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/24
 * Email: <yuantong@srun.com>
 */

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\Payment;
use Pay\Processor\Encryptor;
use Pay\Processor\Parameter;
use yii\helpers\Json;

class AliPay extends Payment
{
    const PRODUCT_CODE = 'FAST_INSTANT_TRADE_PAY';

    public function beforeRequest()
    {
        $params = $this->payload;
        $this->payload = array_merge($this->config, [
            'method' => 'alipay.trade.page.pay',
            'charset'=> 'utf-8',
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

    /**
     * @throws \Exception
     * @throws GuzzleException
     */
    public function createOrder($params): string
    {
        $params['product_code'] = self::PRODUCT_CODE;
        $params = array_merge($this->config, [
            'method' => 'alipay.trade.page.pay',
            'charset'=> 'utf-8',
            'timestamp' => date('Y-m-d H:i:s'),
            'bizcontent' => Json::encode($params)
        ]);

        $data = Parameter::generateSignByAlipay($params);
        $sign = Encryptor::sign($data, $this->config['private_key']);
        $params['sign'] = $sign;
        unset($params['private_key']);

        $body = $this->post($this->api_url, [
            'form_params' => $params,
            'decode_content' => 'gzip', // 设置响应解码方式为 gzip，提高响应速度
            'headers' => [
                'Accept-Encoding' => 'gzip', // 告诉服务器可以返回 gzip 压缩的响应
            ],
        ]);

        return iconv('GBK', 'UTF-8//IGNORE', $body);
    }

    public function query($out_trade_no)
    {

    }
}