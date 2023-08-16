<?php

namespace Pay\Components;

use Pay\Gateways\AliPay;
use Pay\Gateways\WeChat;
use yii\base\Component;

/**
 * @property AliPay $alipay
 * @property WeChat $weChat
 */
class Payment extends Component
{
    /**
     * @var WeChat
     */
    private WeChat $_wechat;
    /**
     * @var AliPay
     */
    private AliPay $_alipay;

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function getWechat(): WeChat
    {
        return $this->_wechat;
    }

    public function setWechat($config)
    {
        $this->_wechat = new WeChat($config);
    }

    public function getAlipay(): AliPay
    {
        return $this->_alipay;
    }

    public function setAlipay($config)
    {
        $this->_alipay = new AliPay(array_merge($config, [
            'sign_type' => 'RSA2',
            'charset' => 'utf-8',
            'version' => '1.0',
            'format' => 'json',
        ]));
    }
}