<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'starts_at',
        'ends_at',
        'published',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'date',
            'ends_at' => 'date',
            'published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function getPeriodAttribute(): string
    {
        if (! $this->starts_at && ! $this->ends_at) {
            return 'Постоянная акция';
        }

        $start = $this->starts_at?->translatedFormat('j F');
        $end = $this->ends_at?->translatedFormat('j F');

        return trim('c '.($start ?? '').($end ? ' по '.$end : ''));
    }
}
