<?php

namespace App\Traits;

use App\Models\QrCode;
use App\Models\Table;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;

trait GeneratesQrCode
{

    public function generateQrCode($table): void
    {
        $qr_code_data = QrCode::latest()->firstOrFail();
        list($r, $g, $b) = sscanf($qr_code_data->color, "#%02x%02x%02x");

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data(env('APP_URL').'/browse/'.$table->id)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size($qr_code_data->width)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText($table->name)
            ->foregroundColor(new Color($r,$g,$b))
            ->labelFont(new NotoSans(10))
            ->labelTextColor(new Color(107,114,128))
            ->labelAlignment(new LabelAlignmentCenter())
            ->validateResult(false)
            ->build();

        $qr_image_path = storage_path().'/app/public/'. 'qrcodes/'.$table->tenant_id;
        if (! File::exists($qr_image_path)) {
            File::makeDirectory($qr_image_path,0777, true);
        }

        // Save it to a file
        $result->saveToFile(
            $qr_image_path.'/'.'qrcode_table'.$table->id.'.png'
        );
        $table = Table::findOrFail($table->id);
        $table->qr_code = 'qrcodes/'.$table->tenant_id.'/'.'qrcode_table'.$table->id.'.png';
        $table->save();
    }

}
