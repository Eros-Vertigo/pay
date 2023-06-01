<?php
/**
 *
 * User: yuantong
 * Date: 2023/6/1
 * Email: <yuantong@srun.com>
 */

namespace Pay\Gateways\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;

class WechatModel extends Model
{
    /**
     * @var mixed 公众账号ID
     */
    public $appid;
    /**
     * @var mixed 商户号
     */
    public $mch_id;
    /**
     * @var mixed 随机字符串
     */
    public $nonce_str;
    /**
     * @var mixed API密钥
     */
    public $key;
    /**
     * @var mixed 异步通知地址
     */
    public $notify_url;

    /**
     * rules
     * @return array
     * @author yt <yuantong@srun.com>
     */
    public function rules()
    {
        return [
            [['appid', 'mch_id', 'key', 'notify_url'], 'required'],
            [['appid', 'mch_id', 'key'], 'string', 'max' => 32],
            [['notify_url'], 'url'],
        ];
    }

    /**
     * attributeLabels
     * @return string[]
     * @author yt <yuantong@srun.com>
     */
    public function attributeLabels()
    {
        return [
            'appid' => '公众账号ID',
            'mch_id' => '商户号',
            'key' => 'API密钥',
            'notify_url' => '异步通知地址',
        ];
    }

    /**
     * validateConfig
     * @param $config
     * @author yt <yuantong@srun.com>
     */
    public static function validateConfig($config)
    {
        $model = new static();
        $model->load($config, '');
        if (!$model->validate()) {
            throw new InvalidArgumentException(current($model->getFirstErrors()));
        }
    }
}