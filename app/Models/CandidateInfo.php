<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_log_id',
        'branch_name_for_mock',
        'purpose_of_ielts',
        'phone_number',
        'student_source'
    ];
}
