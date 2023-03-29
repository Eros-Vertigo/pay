<?php

use Mero\Monolog\MonologComponent;
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
 * @property PaymentFactory $payment
 */
class Application extends \yii\web\Application
{

}