<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
 
   
    protected $fillable = [
        'product_id',
        'quantity',
        'customer_name',
        'payment_method',
        'status',
        'invoice_number',
        'transaction_id',
        'seller_id',
        'total_price'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

}
