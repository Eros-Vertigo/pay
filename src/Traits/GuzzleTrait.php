<?php

namespace Pay\Traits;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Guzzle Trait
 * User: yuantong
 * Date: 2023/3/28
 * Email: <yuantong@srun.com>
 */
trait GuzzleTrait
{
    /**
     * post request
     *
     * @param $uri
     * @param $payload
     * @return string
     * @throws GuzzleException
     * @throws Exception
     */
    public function post($uri, $payload): string
    {
        $response = $this->client->post($uri, $payload);

        return $response->getBody()->getContents();
    }

}