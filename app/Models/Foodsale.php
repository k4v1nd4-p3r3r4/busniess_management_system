<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Foodsale extends Model
{
    use HasFactory;

    protected $table = 'foodsales';
    protected $primaryKey = 'sale_id';
    public $incrementing = true;

    protected $fillable = [
        'food_id',
        'customer_id',
        'date',
        'qty',
        'unit_price',
        'total_amount',
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'food_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public static function boot()
{
    parent::boot();

    static::saving(function ($model) {
        $model->total_amount = $model->qty * $model->unit_price;
    });
}
}
