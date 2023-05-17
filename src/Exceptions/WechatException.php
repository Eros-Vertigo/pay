<?php
/**
 * 微信支付网关异常处理
 * User: yuantong
 * Date: 2023/5/17
 * Email: <yuantong@srun.com>
 */

namespace Pay\Exceptions;

use Throwable;
use yii\base\Exception;
use yii\helpers\Json;

class WechatException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return Json::encode([
            'code' => $this->code,
            'success' => false,
            'message' => $this->message
        ]);
    }
}