<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QrCodeRequest;
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
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    public function store(QrCodeRequest $request): JsonResponse
    {
        $this->authorize('create', QrCode::class);
        $data = $request->validated();
        $qr_code_data = QrCode::updateOrCreate(
            ['tenant_id' =>  request()->header('X-TENANT-ID')],
            $data
        );
        return response()->json([
            'status' => 'success',
            'message' => 'QR Code features successfully saved',
            'data' => $qr_code_data,
        ], 200);
    }

    public function showQrFeatures(): JsonResponse
    {
        $this->authorize('viewAny', QrCode::class);
        $qr_appearance = QrCode::where('tenant_id', request()->header('X-TENANT-ID'))->first();
        return response()->json([
            'data' => $qr_appearance,
        ], 200);
    }
}
