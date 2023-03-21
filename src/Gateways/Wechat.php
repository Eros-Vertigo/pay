<?php

namespace Pay\Gateways;

use Pay\Contracts\PaymentInterface;
use yii\base\Model;

/**
 *
 * User: yuantong
 * Date: 2023/3/21
 * Email: <yuantong@srun.com>
 */
class Wechat extends Model implements PaymentInterface
{
    public $gateway;
    public $appid;
    public $mch_id;
    public $out_trade_no;
    public $total_fee;
    public $notify_url;
    public $trade_type;

    public function rules(): array
    {
        return [
            [['appid', 'mch_id', 'out_trade_no', 'total_fee', 'notify_url', 'trade_type'], 'required'],
            [['appid', 'mch_id', 'out_trade_no'], 'string', 'max' => 32],
            [['total_fee'], 'integer', 'min' => 1],
            [['notify_url'], 'url'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'appid' => '公众账号ID',
            'mch_id' => '商户好',
            'out_trade_no' => '商户订单号',
            'total_fee' => '金额',
            'notify_url' => '异步通知地址(必须为外网可访问url)',
            'trade_type' => '交易类型',
        ];
    }

    public function getInstance()
    {

    }

    public function createOrder()
    {
        var_dump('createOrder');
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function refund()
    {
        // TODO: Implement refund() method.
    }

    public function notify()
    {
        // TODO: Implement notify() method.
    }

    public function queryOrder()
    {
        // TODO: Implement queryOrder() method.
    }

    public function closeOrder()
    {
        // TODO: Implement closeOrder() method.
    }

    public function cancelOrder()
    {
        // TODO: Implement cancelOrder() method.
    }

    public function verifySign()
    {
        // TODO: Implement verifySign() method.
    }

    public function generateSign()
    {
        // TODO: Implement generateSign() method.
    }
}