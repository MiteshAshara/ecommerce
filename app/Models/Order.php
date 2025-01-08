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
                $usernamePrefix = substr(strtoupper(auth()->user()->name), 0, 3);
                if (strlen($usernamePrefix) < 3) {
                    $usernamePrefix = str_pad($usernamePrefix, 3, 'X');
                }
                $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $order->order_number = "#ord{$usernamePrefix}{$randomDigits}";
            } while (self::where('order_number', $order->order_number)->exists());
        });
    }

    protected $attributes = [
        'order_status' => 'recevied', 
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
