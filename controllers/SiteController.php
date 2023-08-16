<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */

namespace app\controllers;

use GuzzleHttp\Exception\GuzzleException;
use Pay\Processor\Qrcoder;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Site Index
     */
    public function actionIndex()
    {
        $params = [
            'out_trade_no' => time().mt_rand(10000, 99999),
            'total_amount' => 0.01,
            'subject' => '订单标题',
        ];
        $payment = Yii::$app->payment;
        try {
            $result = $payment->alipay->web($params);
//            $result = $payment->alipay->query(time().mt_rand(10000, 99999));
//            var_dump($result);exit;
            $this->layout = false;
            return $this->redirect($result);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function actionWechat()
    {
        $params = [
            'out_trade_no' => '20150320010101001',
            'total_fee' => 1,
        ];
        $payment = Yii::$app->payment;
        try {
            $result = $payment->wechat->web($params);
            $this->layout = false;
            return Json::decode($result);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @throws \Exception
     */
    public function actionTest()
    {
//        $this->layout = false;
//        $json = [
//            "return_code" => "SUCCESS",
//            "return_msg" => "OK",
//            "result_code" => "SUCCESS",
//            "mch_id" => "1625300911",
//            "appid" => "wx1a238606a6d64130",
//            "device_info" => "1000",
//            "nonce_str" => "emKfzR5as2ynxcdi",
//            "generateSign" => "7CBAF9A7444941C54C99E4B2CCB4E20B",
//            "prepay_id" => "wx16112517966886a15e736f1ad7c0b30000",
//            "trade_type" => "NATIVE",
//            "code_url" => "weixin://wxpay/bizpayurl?pr=8gHnhUGzz",
//        ];
//        $payment = Yii::$app->payment;
//        $result = $payment->wechat->parseResponse($json);
//        $qrcode = Qrcoder::write($result);
//        return $this->render('wechat', [
//            'qrcode' => $qrcode
//        ]);
    }
}