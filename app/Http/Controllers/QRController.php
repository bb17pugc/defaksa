<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Restaurant;


class QRController extends Controller
{
    public function generateQR()
    {
$restaurant = Restaurant::get()->first();
        $app_url= env('APP_URL');
        $QRCode = QrCode::size('300')->generate($app_url."/menu-links");
        return response()->view('qr-code', ['rastuarant'=>$restaurant,'QRCode' => $QRCode]);
    }
}
