<?php

namespace Pay\Gateways;

use Pay\Contracts\PaymentInterface;
use yii\base\Model;

/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class Wechat extends Model implements PaymentInterface
{
    public function createOrder()
    {
        var_dump('createOrder');
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function refund()
    {
        // TODO: Implement refund() method.
    }

    public function notify()
    {
        // TODO: Implement notify() method.
    }

    public function queryOrder()
    {
        // TODO: Implement queryOrder() method.
    }

    public function closeOrder()
    {
        // TODO: Implement closeOrder() method.
    }

    public function cancelOrder()
    {
        // TODO: Implement cancelOrder() method.
    }

    public function verifySign()
    {
        // TODO: Implement verifySign() method.
    }

    public function generateSign()
    {
        // TODO: Implement generateSign() method.
    }
}