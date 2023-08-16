<?php

use Mero\Monolog\MonologComponent;
use Pay\Components\Payment;
use Pay\Factories\PaymentFactory;

/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class Yii
{
    /**
     * @var Application
     */
    public static $app;
}

/**
 * @property
 * @property MonologComponent $monolog
 * @property Payment $payment
 */
class Application extends \yii\web\Application
{

}