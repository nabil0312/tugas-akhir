<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Room;
use App\Models\Borrowing;
use App\Http\Controllers\BorrowingController;
use Barryvdh\DomPDF\Facade\Pdf;



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

        $user = User::create([

            'name' => $request->nama,
            'email' => 'user' . rand(1000,9999) . '@gmail.com',
            'password' => bcrypt('123456'),
            'rfid_uid' => $request->rfid_uid

        ]);

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
    $borrowing = Borrowing::create([

        'user_id' => $user->id,
        'room_id' => $room->id,

        // INI YANG PENTING
        'borrower_name' => $request->nama,

        'class' => 'XI RPL',
        'purpose' => 'Peminjaman RFID',
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'borrowed_at' => now(),
        'status' => 'dipinjam'

    ]);

    // UPDATE STATUS RUANGAN
    $room->update([

        'status' => 'dipinjam'

    ]);

    // KEMBALI KE HALAMAN RFID DENGAN PESAN SUKSES
    return back()->with([
        'success' => 'Ruangan "' . $room->nama_ruangan . '" berhasil dipinjam atas nama ' . $request->nama,
        'borrowing_id' => $borrowing->id
    ]);

});



Route::get('/receipt/{id}', function ($id) {

    $borrowing = Borrowing::with('room')->findOrFail($id);

    return view('receipt', compact('borrowing'));

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
        'Ruangan "' . $borrow->room->nama_ruangan . '" berhasil dikembalikan'
    );

});

Route::middleware('auth')->group(function () {

    Route::post('/pinjam/{id}', [BorrowingController::class, 'pinjam']);
    Route::post('/kembali/{id}', [BorrowingController::class, 'kembali']);

});

Route::delete('/riwayat/{id}', function ($id) {

    $history = Borrowing::find($id);

    if ($history) {
        $history->delete();
    }

    return back()->with('success', 'Riwayat berhasil dihapus');

});