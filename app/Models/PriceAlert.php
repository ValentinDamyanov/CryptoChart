<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceAlert extends Model
{
    use HasFactory;

    protected $table = 'price_alert';
    protected $fillable = [
        'price', 'email'
    ];
}
