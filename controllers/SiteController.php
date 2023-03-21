<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */

namespace app\controllers;

use Pay\Gateways\Wechat;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $order_num = mt_rand(1000000, 9999999);
        echo '<pre>';
        var_dump($order_num);
        $model = new Wechat();
        if (!$model->validate()) {
            var_dump($model->errors);
        }
        echo '<pre>';
    }
}