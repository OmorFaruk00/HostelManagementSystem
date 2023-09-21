<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function hostel()
    {
        return $this->belongsTo('App\Models\Hostel', 'hostel_id', 'id');
    }
}
