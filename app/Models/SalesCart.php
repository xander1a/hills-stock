<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'status',
        'customer_name',
        'customer_phone',
        'notes',
        'sale_date',
        'export_type' 
    ];

    protected $casts = [
        'sale_date' => 'datetime',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2'
    ];

    /**
     * Get the product associated with the cart item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope to get items by session
     */
    public function scopeBySession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    /**
     * Scope to get pending items
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Generate a new session ID
     */
    public static function generateSessionId()
    {
        return 'SALE_' . time() . '_' . uniqid();
    }
}