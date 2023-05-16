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
            'app_id' => '2021003128646054',
            'sign_type' => 'RSA2',
            'version' => '1.0',
            'format' => 'json',
            'private_key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCoLgJxalPXn5szQ1MtRxzVOiAn9Qit3zndr399O7cSQUD7a1kdZiAVJouv+Afa0nHeAeG734+o5noYQGgKyMlJ6q2MHa4R+X+moTVCrGHv3aiwO4+lMU/N/foshfvlWNwPX2ApS47lAJWpbVYf6LgpZZT/S/E2rkmquCAr8GKnatN1/iIlvkJzy6r5NV9RF5OaF5aekQ+JC28H3hl+GdRm1wXA8+Q6kmRv4PMscDy2cl3ifk9WhX7QhPa28gV9UgYaFZ7cnRV/IaUw0fpTP/ppX26ZG3ZXkVlXvhoD+dOkInRhsABP58IlX4nbMcw8/Ud2L48vr//L8EWMfgJ1YYEvAgMBAAECggEASCKj7Z2bpKrS2OQRsyQDW/n4fOr+9AUBPvLdjguk9HGEu9JJgPCi5i+ITsvmIpeNO5o3BmxXpCxnRiup9KY2oDvGgIjidtc7R29x9s0VnNrIVf7WGBbUkhhTy/EUIEVC7l0MU+oSumrLxsYc4Mbi5u6pP++E4N1Uv6MGOZJ73i6iozauYHBPR+PymVrFZFMlrymNLiNpeZDpwZcDAiw19OecG2XyHBZXREw7anyXoXHepGEBPbWLRTO8QAV5oqIf5XGCkJzQ9wrHLum3EpNyBElYZn2JnfEmoWAW0fjptsiDox33dgtq/+XVy5ca1LxZurf+ySsAU4A4abvW8wI7YQKBgQDoyfiHt4/h4nYw5MsvVzcp3CpHCrU1df91iZV4vpQsV7Kwh7Wz7dPNtG1d+FwAD+3yvGwUi1+Yceyqjk3vcXS/Fk1FfZ4L7FGir+bhLj9UrxHNrLT2GX8E2rjTFZtE8is0ruNlF2W3NssYRi0n1FquENwe/1CWCUnXE4LXd5tm+QKBgQC48tzqoqZf6QFzVCI3amq/37P4NQMksFvi4ouv35FindqTFoIPIan1QgWzDMXXlGq8XQbLbPlEKmb12BUNr2ADiQZLnkciBKdDPVFC9itRWA/XBV9g0+mZE/3AuojH2p4kLiGD9g4CTf8JJbivcq25TBoRck9VqmJGYjYMT5lrZwKBgB+IA/b2ITIah6HVy8PMz3cHEF7xD1x/cCvOiAWD4vQiqNyKdU064J6TWuEInAWSIsvnQ8iAnGE8xS7Q+bN+La8YaT0JZ9f7mY8svlwv9HoXAJVYWGahS3gv3CsTWSW8m6eWLMzrn2ZysI3IK6Oieunq9LXqJVM9TNgqF2XyGIWZAoGAMO54Sk+sCvX/nz6kKtsp0Qfjeoi0AzHxrY5YfLh+o4O1/3JWCKDUcYH9NgjsEwQ+VQWbtZhoPoOlZ+e6cjtzAJxxIPKISVTH1/9SD5BHl6bf0fim6lxGkmx6l1ICvDV334Sg82PXAv8VuZrUSP7jPYIH55PBr517kLmNKSaqJYMCgYEA54TRohrM2RzLe154PNujmEkkYkgGC+ya7j1t8YLSPWeufWK4qymN3sbvIJFNh9lCdIw51ZITIK+Ic7wHqgSOKop+XPuyMeHs4R/xqaPo0JDQx9TDRWPUlLPpUxd1eQqq59EqQI0DvWoHzDbNRInF4aDr0cJAjZ6bj0rlgqfUmkU='
        ];
    }
}