<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'text-yellow-600',
            'confirmed' => 'text-blue-600',
            'processing' => 'text-purple-600',
            'shipped' => 'text-indigo-600',
            'delivered' => 'text-green-600',
            'cancelled' => 'text-red-600',
            default => 'text-gray-600',
        };
    }
}