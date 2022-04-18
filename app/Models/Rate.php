<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = [
        'pair_id', 'data', 'last_price'
    ];

    public function pair(): BelongsTo
    {
        return $this->belongsTo('App\Models\Pair');
    }
}
