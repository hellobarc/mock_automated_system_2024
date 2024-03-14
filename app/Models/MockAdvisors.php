<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockAdvisors extends Model
{
    use HasFactory;

    protected $fillable = [
        'advisor_name',
    ];
}
