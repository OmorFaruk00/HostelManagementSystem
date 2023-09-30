<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function hostel()
    {
        return $this->hasOne('App\Models\Hostel', 'id','hostel_id')->select('id','name');
    }
    public function room()
    {
        return $this->hasOne('App\Models\Room', 'id','room_id')->select('id','room');
    }
}
