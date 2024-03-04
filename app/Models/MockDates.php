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
}
