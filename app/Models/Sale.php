<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'code',
        'client_id',
        'user_id',
        'datetime',
        'total_amount'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function saleProducts(): HasMany
    {
        return $this->hasMany(SaleProduct::class, 'sale_id', 'id');
    }
}
