<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class speakingTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'mock_date_id',
        'time',
        'assinged_count'
    ];
    
}
