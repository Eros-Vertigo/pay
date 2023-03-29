<?php
namespace Pay\Processor;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use http\Exception\InvalidArgumentException;

/**
 * Guzzle Requester
 * User: yuantong
 * Date: 2023/3/27
 * Email: <yuantong@srun.com>
 */
class ApiSender
{
    /**
     * @var mixed 请求地址
     */
    protected $baseUri;
    /**
     * @var mixed 配置项
     */
    protected $config;
    /**
     * Instance
     *
     * @var Client
     */
    private static Client $instance;

    public static function getInstance(): Client
    {
        if (is_null(self::$instance)) {
            throw new InvalidArgumentException('You should [Create] First Before Using');
        }

        return self::$instance;
    }

    public static function setInstance($config): Client
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new Client($config);
        }
        return self::$instance;
    }

    /**
     * @throws GuzzleException
     */
    public static function post()
    {
        self::$instance->post('', [

        ]);
    }
}