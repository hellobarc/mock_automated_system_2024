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

    public function CandidateLog(){
        return $this->belongsTo(CandidateLog::class, 'candidate_logs_id');
    }

    public function MockDate(){
        return $this->belongsTo(MockDates::class, 'mock_dates_id');
    }

    public function SpeakingTime(){
        return $this->belongsTo(SpeakingTime::class, 'speaking_time_id');
    }
}
