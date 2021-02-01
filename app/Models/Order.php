<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'tracking_no',
        'tracking_message',
        'payment_mode',
        'payment_id',
        'payment_status',
        'order_status',
        'cancel_reason',
        'notify',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function orderItems(){
        return $this->hasMany(Orderitem::class,'order_id','id');
    }
}
