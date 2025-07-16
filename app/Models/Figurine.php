<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Figurine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'series', 'edition', 'imagePath', 'purchaseDate', 'condition', 'categories', 'rarity','user_id'
    ];

    // Scope for filtering by series
    public function scopeSeries($query, $series)
    {
        return $series ? $query->where('series', $series) : $query;
    }

    // Scope for filtering by rarity
    public function scopeRarity($query, $rarity)
    {
        return $rarity ? $query->where('rarity', $rarity) : $query;
    }

    // Scope for filtering by purchase date range
    public function scopePurchaseDate($query, $dateRange)
    {
        if ($dateRange === 'last30days') {
            return $query->where('purchase_date', '>=', now()->subDays(30));
        } elseif ($dateRange === 'lastyear') {
            return $query->where('purchase_date', '>=', now()->subYear());
        }
        return $query;
    }

    // Scope for filtering by condition
    public function scopeCondition($query, $condition)
    {
        return $condition ? $query->where('condition', $condition) : $query;
    }
}