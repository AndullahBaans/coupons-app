<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'external_id', 'title', 'code', 'discount_value', 'expires_at', 'is_active'];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}