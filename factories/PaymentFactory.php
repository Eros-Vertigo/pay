<?php

namespace app\factories;

use Pay\Gateways\AliPay;
use Pay\Gateways\WeChat;
use yii\base\Component;

/**
 *
 * User: yuantong
 * Date: 2023/3/27
 * Email: <yuantong@srun.com>
 */
class PaymentFactory extends Component
{
    const WECHAT_URL = 'https://api.mch.weixin.qq.com';

    public static function createPayment($type)
    {
        switch ($type) {
            case 'wechat':
                return new WeChat(self::wechatConfig(), self::WECHAT_URL);
            case 'alipay':
                return new AliPay(self::alipayConfig());
        }
    }

    public static function wechatConfig(): array
    {
        return [
            'appid' => 'wx2421b1c4370ec43b',
            'mch_id' => '10000100',
            'device_info' => 1000,
            'body' => 'test',
            'nonce_str' => 'ec2316275641faa3aacf3cc599e8730f',
            'key' => '192006250b4c09247ec02edce69f6a2d',
        ];
    }

    public static function alipayConfig(): array
    {
        return [];
    }
}