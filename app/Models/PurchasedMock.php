<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedMock extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_log_id',
        'date',
        'payment_status',
        'mock_number',
        'paid_fees',
        'due_fees',
        'total_fees'
    ];
}
