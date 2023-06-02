<?php
/**
 *
 * User: yuantong
 * Date: 2023/6/2
 * Email: <yuantong@srun.com>
 */

namespace Pay\Contracts;

use yii\base\InvalidArgumentException;
use yii\base\Model;

class Validate extends Model implements ValidateInterface
{
    public static function validateConfig($config)
    {
        $model = new static();
        $model->load($config, '');
        if (!$model->validate()) {
            throw new InvalidArgumentException(current($model->getFirstErrors()));
        }
    }
}