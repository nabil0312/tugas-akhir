<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArduinoController extends Controller
{
    public function scanQr(Request $request)
    {
        $qr = $request->qr_code;
        $room = $request->room_id;

        return response()->json([
            'success' => true,
            'message' => 'QR diterima',
            'qr_code' => $qr,
            'room_id' => $room
        ]);
    }
}
