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
abstract class Payment implements PaymentInterface
{
    use GuzzleTrait;

    /**
     * @var mixed 参数配置项
     */
    protected $config;

    /**
     * @var mixed 接口地址
     */
    protected $api_url;
    /**
     * @var Client GuzzleClient
     */
    private Client $client;

    public function __construct($config, $api_url)
    {
        $this->config = $config;
        $this->client = new Client();
        $this->api_url = $api_url;
    }

    protected function success($message, $data): array
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data ?? []
        ];
    }
}