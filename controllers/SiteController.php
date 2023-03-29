<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */

namespace app\controllers;

use app\factories\PaymentFactory;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Site Index
     */
    public function actionIndex()
    {
        $payment = PaymentFactory::createPayment('wechat');
        $res = $payment->query(['transaction_id' => '1008450740201411110005820873']);
        var_dump($res);
    }
}