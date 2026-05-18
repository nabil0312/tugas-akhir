<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Room;
use App\Models\Borrowing;



Route::get('/', function () {

    return view('welcome');

});



Route::get('/dashboard', function () {

    $filter = request('filter');

    if ($filter == 'kosong') {

        $rooms = Room::where('status', 'kosong')->get();

    } elseif ($filter == 'dipinjam') {

        $rooms = Room::where('status', 'dipinjam')->get();

    } else {

        $rooms = Room::all();

    }

    return view('dashboard', compact('rooms'));

});



Route::get('/riwayat', function () {

    $history = Borrowing::with('room')
        ->latest()
        ->get();

    return view('riwayat', compact('history'));

});



Route::get('/rfid', function () {

    $rooms = Room::where('status', 'kosong')->get();

    return view('rfid', compact('rooms'));

});



Route::post('/rfid', function (Request $request) {

    // CEK USER RFID
    $user = User::where(
        'rfid_uid',
        $request->rfid_uid
    )->first();

    if (!$user) {

        return back()->with(
            'error',
            'RFID tidak dikenal'
        );

    }

    // CEK RUANGAN
    $room = Room::find($request->room_id);

    if (!$room) {

        return back()->with(
            'error',
            'Ruangan tidak ditemukan'
        );

    }

    // CEK STATUS RUANGAN
    if ($room->status == 'dipinjam') {

        return back()->with(
            'error',
            'Ruangan sedang dipinjam'
        );

    }

    // SIMPAN PEMINJAMAN
    $borrow = Borrowing::create([

        'room_id' => $room->id,
        'borrower_name' => $user->name,
        'class' => 'XI RPL',
        'purpose' => 'Peminjaman RFID',
        'borrowed_at' => now(),
        'status' => 'dipinjam'

    ]);

    // UPDATE STATUS RUANGAN
    $room->update([

        'status' => 'dipinjam'

    ]);

    // TAMPILKAN STRUK
    return view('receipt', compact('borrow'));

});



Route::get('/return-scan', function () {

    return view('return-scan');

});



Route::post('/return-scan', function () {

    $kode = request('kode');

    // CARI DATA PEMINJAMAN
    $borrow = Borrowing::find($kode);

    if (!$borrow) {

        return back()->with(
            'error',
            'Data peminjaman tidak ditemukan'
        );

    }

    // UPDATE PEMINJAMAN
    $borrow->update([

        'returned_at' => now(),
        'status' => 'dikembalikan'

    ]);

    // UPDATE STATUS RUANGAN
    $borrow->room->update([

        'status' => 'kosong'

    ]);

    return redirect('/dashboard')->with(
        'success',
        'Ruangan berhasil dikembalikan'
    );

});