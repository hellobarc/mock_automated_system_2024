<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'unique_id'
    ];

    public function CandidateInfo(){
        return $this->hasOne(CandidateInfo::class, 'candidate_log_id');
    }

    Public function BookedMockTime(){
        return $this->hasMany(StudentsPurhcasedMockTimes::class, 'candidate_logs_id');
    }
}
