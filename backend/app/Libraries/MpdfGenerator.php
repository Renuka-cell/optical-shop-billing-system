<?php

namespace App\Libraries;

use Mpdf\Mpdf;

class MpdfGenerator
{
    public static function create()
    {
        return new Mpdf([
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10
        ]);
    }
}