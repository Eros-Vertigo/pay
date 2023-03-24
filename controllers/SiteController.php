<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */

namespace app\controllers;

use Pay\Gateways\AliPay;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     */
    public function actionIndex()
    {
        Yii::$app->payment->createPaymentScene('alipay', [
            'class' => AliPay::class
        ]);
    }
}