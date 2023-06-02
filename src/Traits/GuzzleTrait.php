<?php

namespace Pay\Traits;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\InvalidArgumentException;

/**
 * Guzzle Trait
 * User: yuantong
 * Date: 2023/3/28
 * Email: <yuantong@srun.com>
 */
trait GuzzleTrait
{
    /**
     * @var mixed 请求地址
     */
    protected $uri;
    /**
     * @var mixed 请求载体
     */
    protected $payload;

    /**
     * 请求前置操作
     * @author yt <yuantong@srun.com>
     */
    public function beforeRequest()
    {
        if (empty($this->uri)) {
            throw new InvalidArgumentException("Request URL must be have");
        }
    }

    /**
     * 响应前置操作
     * @param $response
     * @return mixed
     * @author yt <yuantong@srun.com>
     */
    public function beforeResponse($response)
    {
        return $response->getBody()->getContents();
    }

    /**
     * post request
     *
     * @return string
     * @throws GuzzleException
     * @throws Exception
     */
    public function post()
    {
        $this->beforeRequest();
        $response = $this->client->post($this->uri, $this->payload);

        return $this->beforeResponse($response);
    }

    /**
     * @throws GuzzleException
     */
    public function get($uri, $query): string
    {
        $response = $this->client->get($uri, $query);

        return $response->getBody()->getContents();
    }
}