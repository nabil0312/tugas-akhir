<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['nama_ruangan', 'status'];

    public function borrowings()
        {
            return $this->hasMany(Borrowing::class);
        }
}