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
    const ALIPAY_URL = 'https://openapi.alipay.com/gateway.do';

    public static function createPayment($type)
    {
        switch ($type) {
            case 'wechat':
                return new WeChat(self::wechatConfig(), self::WECHAT_URL);
            case 'alipay':
                return new AliPay(self::alipayConfig(), self::ALIPAY_URL);
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
        return [
            'app_id' => '24610',
            'charset' => 'GBK',
            'sign_type' => 'RSA2',
            'sign' => '',
            'version' => '1.0',
            'format' => 'json',
            'private_key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCbEDz9KYamtz1HtsskbYXW0QQfS7xY+EuScQ2S/oJu0Qovn+sjjEe5Iumq2CXhUb7O0+jUEmAF1rifpi6njwfq1gpoalALdiqd3ikXU0iAzA7jkpnViIkqcoXlTaX/GlTFVJjVtqnMh1uA1ozWQxxWVJIa7LoXQD5rkxKKP34zl3XJNMkRnhEUNNocf2jYR7Sp9LY6JNAnMyb7AVcMKpAlDL4do5rJbTaqrXwJZnwRBUPbPdBfVNbQT7SWLCEnPAAalIqhkWQH42lbbnAGMooH026Qh1Mlcfn9549lGuOAUlEckZevgxyQXOzWYcJeSYttNVznIS1KoS5nCde8kU6fAgMBAAECggEAXLh0/5yZG49uYTd4eSvUYANTx7LtyPWPmt1nFIKDU+hDgv7JB9SV/qpVtwbQf871nY8xJb5nFJa0hyJDu4XXYiDi0FTh0Di0evmg8IWoUPuz23iJ7Blci7k3P0oS/FuuXOCdEw3KsrYtjPi99lDi3OxtARSUodqUeJbU+z3EJOx6B1Uguef9USUDjgv2Hk2GfijCRxxEUj+XtK+GalkvlhxkUmH4h2W8Yb+D+DcW8thshDX6ZJtE7Qa6frTeIavoEeoOBVGbEjHcPLZNitWKZEnyZM/G8BSQJ4kD/Iusr1kMFJhycEtceFUoKc80blNfC5Bt2xmh/m/08Rw4chbpoQKBgQDH5mdpnzmKFYPP1f/MAE7L9rJcrg3yHtUYd4AtX+X7WxliSHRvzgn3qNRuFlF7LwP4vH8XEqP/z1WmnW7huPceeY441l/4MoK2Mi7Eqvtvb5eZpWfHOMcVd4syMmngzzhUsHXc9N8V8pDd1yR+Fl3HuT0OxbLt3hKTFQ1ukOA6UwKBgQDGlJls1PpqqX23ImpeFvLyMAl2AQ8IKieWjAcxFOxGFqt1PVNC2zTQUm9RyTN6HY95LxYc+GjDFyntvlDTuwbqKWloFktdwCCqE7oMtf+YRSmt/gBZNMp068qjPlkMIZufdy8mkIhmpdWr3WeOqhF2NQFqWsOiiVBeOGWMsWfJBQKBgDZE1s5V68kRDjfeYROBAeNdlg6TMjYJKND7oFCxOD6E/N8xzGqOBSa3LvS0GmrW2L0ub1JUPTG1mAsjsnaVQIGFfpbvnB5FmDbeaNP7l0cphH6x6Pqs719klOWLyjK+Dwzu2xChae8La0jOn5mbeNo/79OS2IC7SU+k54Cc1EMBAoGBAMKC1+20iD1mG9AAk/PpwrrbtsixrMmwkOpz6q928SCOIBBMq3u3P/o2ZPfVfujEf76SErT51ZQS4m0PmBhtAA7p1WexPs1r3hL6E6lTtDKwvGzDeg/nF9CDDg/siEjLuqXulm7N7+2rzqnzyvYBO+1vah2FHk/c9K31y/KN6z0JAoGBAIvw4x/UjnnhkYqrxtyRoG4YEgP3ARbilpOdPRAWuy9B9t7z0sQ+peY+Cz2tfDcK8Aw1KOJp8r/NCcQZZ+4KnNPno29e7TgfCLMWbNAvAs69D/Hlr3GqBd7z7FiIdEpRVfCAtk0xffpvg/xOyc7C+ifn522XjoLadvQwXGR1pZ7X'
        ];
    }
}