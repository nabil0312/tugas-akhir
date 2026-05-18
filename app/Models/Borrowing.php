<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
    'room_id',
    'borrower_name',
    'class',
    'purpose',
    'borrowed_at',
    'returned_at',
    'status'
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    
}