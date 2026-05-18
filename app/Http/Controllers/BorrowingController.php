<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Borrowing;

class BorrowingController extends Controller
{
    public function pinjam($id)
    {
        $room = Room::findOrFail($id);

        if ($room->status == 'dipinjam') {
            return back()->with('error', 'Ruangan sedang dipinjam');
        }

        Borrowing::create([
        'room_id' => $room->id,
        'borrower_name' => 'Nabil',
        'class' => 'XI RPL',
        'purpose' => 'Belajar',
        'borrowed_at' => now(),
        'status' => 'dipinjam'
    ]);

        $room->update(['status' => 'dipinjam']);

        return back()->with('success', 'Berhasil meminjam');
    }

    public function kembali($id)
    {
        $borrow = Borrowing::where('room_id', $id)
                    ->where('status', 'dipinjam')
                    ->first();

        if ($borrow) {
            $borrow->update([
                'returned_at' => now(),
                'status' => 'dikembalikan'
            ]);

            $borrow->room->update(['status' => 'kosong']);
        }

        return back()->with('success', 'Ruangan dikembalikan');
    }
}