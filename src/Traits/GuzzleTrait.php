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
    protected function beforeRequest()
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
    protected function beforeResponse($response)
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
    protected function post(): string
    {
        $this->beforeRequest();
        $response = $this->client->post($this->uri, $this->payload);

        return $this->beforeResponse($response);
    }

    /**
     * @throws GuzzleException
     */
    protected function get(): string
    {
        $this->beforeRequest();
        $response = $this->client->get($this->uri.'?'.http_build_query($this->payload));

        return $this->beforeResponse($response);
    }

    /**
     * Build pay url
     * @return string
     * @author yt <yuantong@srun.com>
     */
    protected function buildUrl(): string
    {
        $this->beforeRequest();
        return $this->uri.'?'.http_build_query($this->payload);
    }
}