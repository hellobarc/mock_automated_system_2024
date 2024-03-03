<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateMockStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_log_id',
        'mock_purchase_count',
        'dates_booked',
        'attendance_status'
    ];
}
