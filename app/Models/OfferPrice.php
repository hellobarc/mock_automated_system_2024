<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_table_id',
        'package_count',
        'price' 
    ];
}
