<?php

namespace Pay\Factories;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * 支付工厂类
 * User: yuantong
 * Date: 2023/3/24
 * Email: <yuantong@srun.com>
 */
class PaymentFactory extends Component
{
    /**
     * @throws InvalidConfigException
     */
    public function createPaymentScene($id, $config = [])
    {
        // 检验配置项
        if (empty($config['appid']) || empty($config['secret'])) {
            throw new InvalidConfigException('payment config is miss');
        }

        return Yii::createObject($config['class'], [$config]);
    }
}