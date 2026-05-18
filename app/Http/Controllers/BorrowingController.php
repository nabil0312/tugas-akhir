<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{       
    public function pinjam(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // cek status ruangan
        if ($room->status == 'dipinjam') {
            return back()->with('error', 'Ruangan sedang dipinjam');
        }

        // simpan borrowing
        $borrowing = Borrowing::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'borrower_name' => $request->input('borrower_name'),
            'class' => $request->input('class'),
            'purpose' => $request->input('purpose'),
            'borrowed_at' => now(),
            'status' => 'dipinjam'
        ]);

        // update room
        $room->update([
            'status' => 'dipinjam'
        ]);

        // tampilkan receipt
        return view('receipt', compact('borrowing'));
    }

    public function kembali($id)
    {
        $borrow = Borrowing::where('room_id', $id)
            ->where('status', 'dipinjam')
            ->first();

        if (!$borrow) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $borrow->update([
            'returned_at' => now(),
            'status' => 'dikembalikan'
        ]);

        $borrow->room->update([
            'status' => 'kosong'
        ]);

        return back()->with('success', 'Ruangan dikembalikan');
    }
}