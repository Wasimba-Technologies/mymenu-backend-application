<?php

namespace Database\Seeders;

use App\Models\QrCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QrCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QrCode::create([
            'color' => '#000000',
            'width' => 200,
            'caption_line_one' => 'Point your Camera here: ',
            'caption_line_two' => 'to access our menu',
            'sub_caption' => 'Cant Scan? Visit the below link for the menu:',
        ]);
    }
}
