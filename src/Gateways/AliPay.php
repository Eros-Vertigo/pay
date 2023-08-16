<?php
/**
 * 支付宝支付网关
 * User: yuantong
 * Date: 2023/3/24
 * Email: <yuantong@srun.com>
 */

namespace Pay\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Contracts\AbstractPayment;
use Pay\Gateways\models\AlipayModel;
use Pay\Processor\Encryptor;
use Pay\Processor\Parameter;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

class AliPay extends AbstractPayment
{
    const API_URL = 'https://openapi.alipay.com/gateway.do';
    const METHOD = [
        'web' => 'alipay.trade.page.pay',
        'wap' => 'alipay.trade.wap.pay',
        'query' => 'alipay.trade.query',
    ];
    /**
     * @var string 请求方法
     */
    protected string $method = 'alipay.trade.page.pay';

    /**
     * 构造函数
     * 组件配置进行初始化
     * @param $config
     */
    public function __construct($config)
    {
        parent::__construct($config);
        $this->uri = self::API_URL;
        AlipayModel::validateConfig($config);
    }

    /**
     * 请求前置操作
     * @return void
     * @throws InvalidConfigException
     */
    protected function beforeRequest()
    {
        $params = $this->payload;
        $params = array_merge($this->config, [
            'method' => $this->method,
            'timestamp' => date('Y-m-d H:i:s'),
            'biz_content' => Json::encode($params),
        ]);
        $data = Parameter::generateSignByAlipay($params);
        $sign = Encryptor::generateSign($data, $this->config['private_key']);
        $params['sign'] = $sign;
        unset($params['private_key']);

        foreach ($params as $key => $val) {
            $val = str_replace("'", '&apos;', $val);
            $query[$key] = $val;
        }

        $this->payload = $query;
    }

    /**
     * 响应前置操作
     * @param $response
     * @return false|string
     */
    protected function beforeResponse($response)
    {
        $response = parent::beforeResponse($response);
        if (mb_check_encoding($response, 'GBK')) {
            return iconv('GBK', 'UTF-8//IGNORE', $response);
        }
        return $response;
    }

    /**
     * 电脑网站支付
     * @param $params
     * @return string
     */
    public function web($params): string
    {
        $this->payload = array_merge($params, ['product_code' => 'FAST_INSTANT_TRADE_PAY']);
        $this->method = self::METHOD['web'];
        return $this->buildUrl();
    }

    /**
     * 手机网站支付
     * @param $params
     * @return string
     */
    public function wap($params): string
    {
        $this->payload = $params;
        $this->method = self::METHOD['wap'];
        return $this->buildUrl();
    }

    public function pay($params){}

    /**
     * 查询订单
     * @throws GuzzleException
     */
    public function query($out_trade_no)
    {
        $this->payload = compact('out_trade_no');
        $this->method = self::METHOD['query'];
        $response = Json::decode($this->get());
        if (!is_array($response) || !isset($response['alipay_trade_query_response'])) {
            throw new InvalidCallException('订单查询失败');
        }
        $res = $response['alipay_trade_query_response'];
        if ($res['code'] != 10000) {
            throw new InvalidCallException($res['sub_msg']);
        }
        return $res;
    }

    /**
     * 验签
     * @param $params
     * @return bool
     * @throws InvalidConfigException
     */
    public function verifySign($params): bool
    {
        $sign = $params['generateSign'];
        unset($params['generateSign']);
        unset($params['sign_type']);
        $data = urldecode(Parameter::arrayToString($params));
        return Encryptor::verify($data, $sign, $this->config['public_key']);
    }
}