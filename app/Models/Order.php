<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'customer_name',
        'email',
        'phone'
    ];

    public function car()
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }
}
