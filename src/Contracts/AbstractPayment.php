<?php

namespace Pay\Contracts;

use GuzzleHttp\Client;
use Pay\Traits\GuzzleTrait;

/**
 * 支付抽象类
 * User: yuantong
 * Date: 2023/3/27
 * Email: <yuantong@srun.com>
 */
abstract class AbstractPayment implements PaymentInterface
{
    use GuzzleTrait;

    /**
     * @var mixed 参数配置项
     */
    protected $config;

    /**
     * @var Client GuzzleClient
     */
    private Client $client;

    public function __construct($config)
    {
        $this->config = $config;
        $this->client = new Client();
    }
}