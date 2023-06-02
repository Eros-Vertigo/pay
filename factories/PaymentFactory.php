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
    public static function createPayment($type)
    {
        switch ($type) {
            case 'wechat':
                return new WeChat(self::wechatConfig());
            case 'alipay':
                return new AliPay(self::alipayConfig());
        }
    }

    public static function wechatConfig(): array
    {
        return [
            'appid' => 'wx1a238606a6d64130',
            'mch_id' => '1625300911',
            'body' => 'test',
            'nonce_str' => 'ibuaiVcKdpRxkhJA',
            'key' => 'b92178945d3e3c35fa91075f02728dd2',
            'notify_url' => 'https://srunxian.com:59527/pay/notify',
        ];
    }

    public static function alipayConfig(): array
    {
        return [
            'app_id' => '2021003197604902',
            'sign_type' => 'RSA2',
            'charset' => 'utf-8',
            'version' => '1.0',
            'format' => 'json',
            'private_key' => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCOOyi/vGKwjYi37jfoGMdfFJsHyusAlodt4/5of1xUdF5ElTERzQMIgYcJy9avmdKaUbLWBu517VU1o35q2rqvxKUATgeNXfUWJBQksC33M0FLtPmhuH6dKz8CbULrAGaVg/H3WZp1o3JaY8QmxVQGVvslCgsAbMA57oa1KLw0HIhMAmjYoj3Rm/rHsDgZx1m72q53MFkHKBsKT1IinmTQZwD3d9F4cHwAahBzx4KTUfomdpzPRMw89XhRpw5/7N3/w7fGC6QHlmFJ5GmpjVB9Dy3CU1jPf3ox++nXz4lHpJVqy9HdBrLhBSyNosoOp9wcYg7paitO7w69xa5F75qNAgMBAAECggEAZ5t4p5MXYPz45uNFHnFOalicRiTu41LD/KzkmkKMg4jxUoxLXmg1GXEhaWVvUiN/YqK432fVNVpZg+VBJZ2H+JoKiBpPLg+PhT1q3v7nvPc9TWTbo469zMe/8oidAoscLzYagNBoz+DsYCPks0lzV9rsv6J9OSX/MTQsNLMjxeEc6x5ybFgvfbhC8JkhOYrp0H1Auvf8gabKlVz7MN0ydXPTolgv9rEqETfWVCvOb0Cd6+BmzAVb1Lr+38cZUfjK2scs8e9LXSI5pWV3hAIXPSxUb/k2AWEv1LL2jtUfvPY6XvgItuJBQN8IRVtuJoa2/0+eM/y73DiiyR64W89kgQKBgQDCYjfYSlrxOmpHESdtnwbQ6JFBgLz1NY74NcxC7lw1wlworo/wY66LUXgn73mSAccUZf31UTmBCpMckQi5Mjmt8v7ErQQkRRISBHRDyxXuzE5ga2pvErWNAnPki3YG0cOWdGlyGg4GZDDbEYrXfshG2UbVBhoURgexBermkeJy1QKBgQC7UOGM33jvKvCT5hZpjmYrzU6yF+L+nHM2SLTRvcpvTau7W/QzSBoHfi4Tm92zrasASEF4xeYv1mS9zgOML+UunXT3QMYiqqgNFH66jJW8mPJMiJP72TE4jJX3hJ0KVPx58pMm55zZAANZ2RQszvOm0YRiju+nXQwtxONJoYU02QKBgB+Zk/aHb+1TT7+p3D0H4zXG+QYrBYzfXhSfuksPMNJUfGLoreGoctGXNu9XEO5Zd6GrSvO8dpqxu2Sjd0WUEqhinmQetFOpHtzq+HOk6jXd5Mfr7muMIROBWJHI0jEdnKwy1ImGDs2fMAoM+gM6Sxipbchnq4msMMfobF17TdLZAoGALkMpkZtXyOn4BO8ctfE/dq38M6wGmg+VvOB0GCEhsB+kvF9XjprOIu+c/abPOKM5ypYN5YAq+8Gdm+sXoTXrCnpE+xP6W3F+k8xuCDDUgoHbxd8tfVQE/gxqtXkBOB4JRS0N/tvRNx7ztOsSOobaUmcIpTbcJZ+rdFpeMD8+IPECgYBa+CZXJMs/UwJ88F1taQLVfxWEnWVAljncS4ObBK3znJTz64QfpUKIbKva1T+v6AhXhTpCzn0e4li25kMKxZWDnQUP9R7avfYnI8MyPzXIINviVI4o7lpaKLxxENfblA0TNbno/SQJUHH7+74ZqzwBaYGmKLEL4QQKnRLoxlGMmQ=='
        ];
    }
}