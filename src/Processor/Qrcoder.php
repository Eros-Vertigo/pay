<?php
/**
 *
 * User: yuantong
 * Date: 2023/5/23
 * Email: <yuantong@srun.com>
 */

namespace Pay\Processor;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\Result\ResultInterface;

class Qrcoder
{
    /**
     * @param $data
     * @param $logo
     * @return ResultInterface
     * @throws \Exception
     * @author yt <yuantong@srun.com>
     */
    public static function write($data, $logo = null): ResultInterface
    {
        $write = new PngWriter();

        $qrCode = \Endroid\QrCode\QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // 潜入logo
        $label = Label::create('微信支付')
            ->setTextColor(new Color(0, 0, 0));

        return $write->write($qrCode, null, $label);
    }
}