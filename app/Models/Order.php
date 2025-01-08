<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'payment_status',
        'firstname',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'payable_amount',
        'order_status',
        'order_number',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            do {
                $order->order_number = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            } while (self::where('order_number', $order->order_number)->exists());
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
