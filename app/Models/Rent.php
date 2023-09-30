<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function hostel()
    {
        return $this->belongsTo('App\Models\Hostel', 'hostel_id', 'id');
    }
}
