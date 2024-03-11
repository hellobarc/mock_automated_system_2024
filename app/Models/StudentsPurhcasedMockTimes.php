<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsPurhcasedMockTimes extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_logs_id',
        'mock_dates_id',
        'speaking_time_id'
    ];
}
