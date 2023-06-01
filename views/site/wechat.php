<?php

/**
 *
 * User: yuantong
 * Date: 2023/5/26
 * Email: <yuantong@srun.com>
 */
/* @var $qrcode */

use Pay\Widgets\QrcodeWidget;

?>
<h1>wechat</h1>


<?php echo QrcodeWidget::widget(['qr_code' => $qrcode])?>


