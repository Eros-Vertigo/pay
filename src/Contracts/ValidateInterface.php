<?php
/**
 * 验证接口
 * User: yuantong
 * Date: 2023/6/2
 * Email: <yuantong@srun.com>
 */

namespace Pay\Contracts;

interface ValidateInterface
{
    public static function validateConfig($config);
}