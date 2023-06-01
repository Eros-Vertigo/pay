<?php
/**
 * 二维码小组件
 * User: yuantong
 * Date: 2023/5/26
 * Email: <yuantong@srun.com>
 */

namespace Pay\Widgets;

use yii\base\Widget;
use yii\helpers\Html;

class QrcodeWidget extends Widget
{
    /**
     * @var mixed
     */
    public $qr_code;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return Html::tag('img', '', [
            'src' => 'data:image/png;base64,' . base64_encode($this->qr_code->getString()),
            'alt' => 'QR CODE'
        ]);
    }
}