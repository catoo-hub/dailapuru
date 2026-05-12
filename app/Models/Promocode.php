<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promocode extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'valid_until',
        'usage_limit',
        'used_count',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'date',
            'active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isAvailable(): bool
    {
        if (! $this->active) {
            return false;
        }

        if ($this->valid_until && $this->valid_until->isPast()) {
            return false;
        }

        return $this->usage_limit === null || $this->used_count < $this->usage_limit;
    }
}
