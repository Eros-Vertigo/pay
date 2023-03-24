<?php
/**
 *
 * User: yuantong
 * Date: 2023/3/24
 * Email: <yuantong@srun.com>
 */

namespace Pay\Gateways;

use Pay\Contracts\PaymentInterface;

class AliPay implements PaymentInterface
{
    public function createOrder()
    {

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

    public function getConfig()
    {
        return $this->config;
    }
}