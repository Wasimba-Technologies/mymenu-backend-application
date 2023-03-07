<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QrCodeRequest;
use App\Models\Table;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    public function generateQRCode(QrCodeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $tenant_id = $request->header('X-TENANT-ID');

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data(env('APP_URL').'/menu_items?tenant='.$tenant_id)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(200)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText('Table '.$data['table_id'])
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->validateResult(false)
            ->build();

        // Save it to a file
        $result->saveToFile(__DIR__.'/qrcode.png');
        $destination_path = 'qrcodes/'.$tenant_id.'/qrcode_table'.$data['table_id'].'.png';
        Storage::move(__DIR__.'/qrcode.png', $destination_path);
        //Storage::delete(__DIR__.'/qrcode.png');


        // Generate a data URI to include image data inline (i.e. inside an <img> tag)
        $dataUri = $result->getDataUri();

        $table = Table::find($data['table_id'])->get();

        $table->qr_code = $destination_path;


        return response()->json([
            'status' => 'success',
            'message' => 'Code successfully generated',
            'url' => $dataUri
        ], 200);
    }
}
