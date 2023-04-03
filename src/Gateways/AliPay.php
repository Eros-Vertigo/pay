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

    /**
     * @throws \Exception
     * @throws GuzzleException
     */
    public function createOrder($params)
    {
        $params['product_code'] = self::PRODUCT_CODE;
        $params = array_merge($this->config, [
            'method' => 'alipay.trade.page.pay',
            'charset'=> 'UTF-8',
            'sign_type' => 'RSA2',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0',
            'bizcontent' => Json::encode($params)
        ]);
        $data = Parameter::generateSignByAlipay($params);
        $sign = Encryptor::sign($data, $this->config['private_key']);
        $params['sign'] = $sign;
        unset($params['private_key']);

        return $this->post($this->api_url, [
            'form_params' => $params,
            'debug' => true,
        ]);
    }

    public function query($out_trade_no)
    {

        // TODO: Implement query() method.
    }
}