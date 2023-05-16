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
use yii\helpers\Json;
use yii\web\Controller;

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
}