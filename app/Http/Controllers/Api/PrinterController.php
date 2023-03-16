<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Restaurant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;


class PrinterController extends Controller
{
    public function print($id): Response
    {
        $order = Order::with('menu_items')->find($id);
        $total = 0.0;
        foreach($order->menu_items as $item){
            $total += $item->price * $item->pivot->qty;
        }
        $tenant = Restaurant::findOrFail(request()->header('X-TENANT-ID'));

        $data = [
            'order' => $order,
            'total' => $total,
            'tenant' => $tenant,
        ];

        //https://github.com/barryvdh/laravel-dompdf

        $pdf = Pdf::loadView('pdf.invoice', $data);
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="invoice.pdf"',
        ]);
    }
}
