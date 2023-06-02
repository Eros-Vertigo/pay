<?php
/**
 *
 * User: yuantong
 * Date: 2023/6/2
 * Email: <yuantong@srun.com>
 */

namespace Pay\Gateways\models;

use Pay\Contracts\Validate;

class AlipayModel extends Validate
{
    /**
     * @var mixed 商户号
     */
    public $app_id;
    /**
     * @var mixed 私钥
     */
    public $private_key;

    /**
     * @var mixed 回调地址
     */
    public $notify_url;
    public function rules()
    {
        return [
            [['app_id', 'private_key'], 'required'],
            [['notify_url'], 'url']
        ];
    }

    public function attributeLabels()
    {
        return [
            'app_id' => '商户号',
            'private_key' => '私钥',
        ];
    }

}