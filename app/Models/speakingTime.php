<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakingTime extends Model
{
    use HasFactory;

    protected $table = 'speaking_times';

    protected $fillable = [
        'mock_date_id',
        'time',
        'assinged_count'
    ];

    public function MockDates(){
        return $this->belongsTo(MockDate::class);
    }

    Public function BookedMockTime(){
        return $this->hasMany(StudentsPurhcasedMockTimes::class, 'speaking_time_id');
    }
    
}
