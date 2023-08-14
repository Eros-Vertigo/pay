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
            'app_id' => '2021003128646054',
            'sign_type' => 'RSA2',
            'charset' => 'utf-8',
            'version' => '1.0',
            'format' => 'json',
            'private_key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC6cNQRcsqj8BSRbMWbFCVGVeTcrGBoVg8f19YdVXoIHeSS7SdtIn977tNkX+VXVP2WFIx8XBULAVhqGicmviaIgZXysMGguSRCuAEeUJThWG/8q/ytABqdunrDu40oPxy4vxjszefhapA1w4rC/djACkYMCgZO96sC/v83OdgHPAatvNgD5+iteas4gaV4GpKzjnNaqQA4rEB0gm/wfJWUbBYT74zUmHn2XylT83cfp42Xf/PwUCGaNuOP2IXXExNLF9bJnlSDZFYKjHJCYh4ufPhD6hpkpwp/g87Nxv4DVGyxXlOSN5hXIY093ORBfSZj20WbHVLaeicq/AhDtJwjAgMBAAECggEAceRo+Du6pIkN14St9j1JQ/1GsLOwtSwVUyuDximoQXsZXdP36MhRPoE3q7KVJFNsEhl9dJ6/0BhDTZWqYxV37p3S3w2xSyCukP9c14r8V+ixiJX75icRG1eGlTlmUrazMfyzGj3ysBZsABvzEYkGttHP1pztG6JaWpsxhygT2t55/PuGNNgor7LGGao8FpaIQ+R41tV0fXprLmFQFTArAJPyPUCOfyjNLoKf8i/Q6Bp1qR/oRsSgDEv9TesokhvyQXwP1Szgs7GExXkZjCnicXrabFkibUbpEkA3dlLhFqPGotHzl+/W608b4l8DZEID0aQQWcTqreVpzWRxPVki8QKBgQDoWIVKjWsc72+UD+7i0pdbD0HOQjUL8oIHu30u3gzYITu/B+OhBCPmYjvvYr/HYjUzBBx56VqtFEP8Gu5GRi5OV5OseaSTzOZk3w6gsa0/ud3CEu5KKPY52KgIEypGF0EU2nH4SwLv2HQdnWCyLrEstTgczJmjziCdUzVyF1oXCQKBgQDNa+ny6gNK2eqEJFTnBoMAOaR0X+VP6AVLysmUIdOCvprSIbZNOnxJNA53mScIBzDm9g6YQxK/xeluH5q0hjsZDditmCuXcJFW+Ae2vTIuwRCstDZjOaEoyOtuftkPT6mzC6d3jGwfybPueDoD2La7jMk+mZLKd/kwggTQG5+YywKBgG4k6Ks69zg0WZS7KOfmJVJJnUyGHleXkwTPYLzDDxu2RXh96O7/43TnxLnq+jcu20FgBY/Vi+LY5JGywpoV0wXYhm0RDW/zhpTzGSAcmqDHH9VM3CHT4UXy61VIoJWxmGymUbj+9ll1JzaS0LAnal5jWkJsy7jXkqaCN6fqYg7hAoGBAJqT7gQhHEEjIlo1jL4cJE/zEFGSJ9itW+7gtjeGDMeB7rbZL3mF3Siox4ov8TMVVjM2TV0+e8lbgIChv6TArY/432gh7guTZYrwMb3NOQn9tjJ/mb2pDCDIsIEBaw0egTB+QJKxVFvHSGLWjbF/TmJrWrSEk/VPunBKJp0DbGFpAoGBAJJUkgL+/bRsvV05IwWY6hPSmPvsUY/lR2CljGC9vpQI9F1hfttkHOfME7mfXYykuD3Qleb9QAL184BOtqqCs9Bsn2zlpRTmIFNyhAE1qLxjJbwhIgXWi8AE+s4BD/3rXsElkEEU/yKuI1gOntZ+6hnoE/VIlkxmdL5CvBsttEwv'
        ];
    }
}