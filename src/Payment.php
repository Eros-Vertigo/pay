<?php

namespace Pay;

use Pay\Abstracts\AbstractPayment;

/**
 *
 * User: yuantong
 * Date: 2023/3/9
 * Email: <yuantong@srun.com>
 */
class Payment extends AbstractPayment
{
    public function index()
    {
        echo "index";
    }
}