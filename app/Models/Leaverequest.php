<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaverequest extends Model
{
    use HasFactory;
     protected $fillable = [
            'user_id',
            'start_date',
            'end_date',
            'leave_type',
            'status'
        ];

        public function user()
            {
                return $this->belongsTo(User::class);
            }
}
