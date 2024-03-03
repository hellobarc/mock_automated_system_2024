<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'full_name',
        'email',
        'phone_number',
        'branch_name_for_mock',
        'date',
        'student_source',
        'price'
    ];
}
