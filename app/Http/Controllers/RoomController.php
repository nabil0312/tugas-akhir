<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Borrowing;

class RoomController extends Controller
{
    public function borrow(Request $request, Room $room)
    {
        if ($room->status == 'dipinjam') {
            return back()->with('error', 'Ruangan sedang dipinjam');
        }

        Borrowing::create([
            'room_id' => $room->id,
            'borrower_name' => $request->borrower_name,
            'class' => $request->class,
            'purpose' => $request->purpose,
            'borrowed_at' => now(),
            'status' => 'dipinjam'
        ]);

        $room->update([
            'status' => 'dipinjam'
        ]);

        return back()->with('success', 'Ruangan berhasil dipinjam');
    }

    public function return(Room $room)
    {
        $borrowing = Borrowing::where('room_id', $room->id)
            ->where('status', 'dipinjam')
            ->first();

        $borrowing->update([
            'status' => 'dikembalikan',
            'returned_at' => now()
        ]);

        $room->update([
            'status' => 'kosong'
        ]);

        return back()->with('success', 'Ruangan dikembalikan');
    }
    public function history()
    {
        $history = Borrowing::with('room')->latest()->get();

        return view('riwayat', compact('history'));
    }
}