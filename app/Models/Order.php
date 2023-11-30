<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_placed_by',
        'source_city',
        'destination_city',
        'distance',
        'required_fleet_type',
        'weight',
        'order_placed_on',
        'load_by',
        'price',
        'status',
    ];
}
