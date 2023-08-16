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
    public function web($params);

    public function wap($params);

    public function query($out_trade_no);
}