<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_category_id',
        'brand_id', 
        'type_id',
        'size_or_code',
        'name',
        'user_id',
        'category',
        'description',
        'price',
        'total_quantity',
        'min_stock',
        'image_path',
        'sku',
        'supplier'
    ];

    // Relationship with main categories
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }

    // Relationship with brands
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relationship with types
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // Relationship with sales
    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }

    // Calculate total sold quantity
    public function getTotalSoldAttribute()
    {
        return $this->sales()->sum('quantity');
    }

    // Calculate remaining stock
    public function getRemainingStockAttribute()
    {
        return $this->total_quantity - $this->total_sold;
    }

    // Calculate total revenue
    public function getTotalRevenueAttribute()
    {
        return $this->sales()->sum('total_price');
    }

    // Get stock status
    public function getStockStatusAttribute()
    {
        $remaining = $this->remaining_stock;
        $minStock = $this->min_stock ?? 0;
        
        if ($remaining <= $minStock) {
            return 'Low Stock';
        } elseif ($remaining <= $minStock * 2) {
            return 'Medium Stock';
        } else {
            return 'High Stock';
        }
    }

    // Get stock status color
    public function getStockStatusColorAttribute()
    {
        $status = $this->stock_status;
        
        switch ($status) {
            case 'Low Stock':
                return 'bg-red-100 text-red-800';
            case 'Medium Stock':
                return 'bg-yellow-100 text-yellow-800';
            case 'High Stock':
                return 'bg-green-100 text-green-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }







    public function salesCartItems()
{
    return $this->hasMany(SalesCart::class);
}

/**
 * Get completed sales for this product
 */
public function completedSales()
{
    return $this->hasMany(SalesCart::class)->where('status', 'completed');
}

/**
 * Calculate total sold quantity from completed sales
 */
public function getSoldQuantityAttribute()
{
    return $this->completedSales()->sum('quantity');
}

/**
 * Check if product is in stock
 */
public function isInStock()
{
    return $this->total_quantity > 0;
}

/**
 * Get available quantity (total - pending cart items)
 */
public function getAvailableQuantityAttribute()
{
    $pendingQuantity = $this->salesCartItems()->where('status', 'pending')->sum('quantity');
    return $this->total_quantity - $pendingQuantity;
}

public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


}