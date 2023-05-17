<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */

namespace app\controllers;

use app\factories\PaymentFactory;
use GuzzleHttp\Exception\GuzzleException;
use Pay\Exceptions\WechatException;
use Pay\Processor\Parameter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * Site Index
     * @throws GuzzleException
     */
    public function actionIndex(): string
    {
        $payment = PaymentFactory::createPayment('alipay');
        $result = $payment->createOrder([
            'out_trade_no' => '20150320010101001',
            'total_amount' => 0.01,
            'subject' => '订单标题',
        ]);
        $this->layout = false;
        return $this->renderContent($result);
    }

    /**
     * @return string
     * @throws GuzzleException
     * @author yt <yuantong@srun.com>
     */
    public function actionWechat(): string
    {
        $payment = PaymentFactory::createPayment('wechat');
        $result = $payment->createOrder([
            'out_trade_no' => '20150320010101001',
            'total_fee' => 1,
            'trade_type' => 'MWEB',
        ]);
        $this->layout = false;
        return Json::decode($result);
    }

    public function actionTest()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $json = [
            "return_code" => "SUCCESS",
            "return_msg" => "OK",
            "result_code" => "SUCCESS",
            "mch_id" => "1625300911",
            "appid" => "wx1a238606a6d64130",
            "device_info" => "1000",
            "nonce_str" => "emKfzR5as2ynxcdi",
            "sign" => "7CBAF9A7444941C54C99E4B2CCB4E20B",
            "prepay_id" => "wx16112517966886a15e736f1ad7c0b30000",
            "trade_type" => "NATIVE",
            "code_url" => "weixin://wxpay/bizpayurl?pr=8gHnhUGzz",
        ];
        $payment = PaymentFactory::createPayment('wechat');
        return $payment->parseResponse($json);
        exit;
    }
}