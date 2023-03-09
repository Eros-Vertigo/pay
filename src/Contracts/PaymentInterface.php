<?php

namespace Pay\Contracts;
/**
 * 支付网关接口
 * User: yuantong
 * Date: 2023/3/9
 * Email: <yuantong@srun.com>
 */
interface PaymentInterface
{
    public function createOrder();

    public function pay();

    public function refund();

    public function notify();

    public function queryOrder();

    public function closeOrder();

    public function cancelOrder();

    public function verifySign();

    public function generateSign();
}