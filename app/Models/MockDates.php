<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockDates extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_allocation'
    ];

    public function SpeakingTimes(){
        return $this->hasMany(SpeakingTime::class, 'mock_date_id');
    }

    Public function BookedMockTime(){
        return $this->hasMany(StudentsPurhcasedMockTimes::class, 'mock_dates_id');
    }
}
