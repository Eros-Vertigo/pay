<?php

namespace Pay\Abstracts;

use Pay\Contracts\PaymentInterface;
/**
 *
 * User: yuantong
 * Date: 2023/3/9
 * Email: <yuantong@srun.com>
 */
class AbstractPayment implements PaymentInterface
{

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function createOrder()
    {
        // TODO: Implement createOrder() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function pay()
    {
        // TODO: Implement pay() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function refund()
    {
        // TODO: Implement refund() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function notify()
    {
        // TODO: Implement notify() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function queryOrder()
    {
        // TODO: Implement queryOrder() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function closeOrder()
    {
        // TODO: Implement closeOrder() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function cancelOrder()
    {
        // TODO: Implement cancelOrder() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function verifySign()
    {
        // TODO: Implement verifySign() method.
    }

    /**
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function generateSign()
    {
        // TODO: Implement generateSign() method.
}}