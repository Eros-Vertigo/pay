<?php

namespace Pay\Components;

use Pay\Gateways\AliPay;
use Pay\Gateways\WeChat;
use yii\base\Component;

/**
 * @property AliPay $alipay
 * @property WeChat $wechat
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

    public function getWechat(): WeChat
    {
        return $this->_wechat;
    }

    public function setWechat($wechat)
    {
        $this->_wechat = new WeChat($wechat);
    }

    public function getAlipay(): AliPay
    {
        return $this->_alipay;
    }

    public function setAlipay($alipay)
    {
        $this->_alipay = new AliPay(array_merge($alipay, [
            'sign_type' => 'RSA2',
            'charset' => 'utf-8',
            'version' => '1.0',
            'format' => 'json',
        ]));
    }
}