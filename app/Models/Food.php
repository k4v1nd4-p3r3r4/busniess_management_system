<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $primaryKey = 'food_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'food_id',
        'food_name',
        'unit',
        'qty',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->food_id = $model->generateFoodId();
        });
    }

    private function generateFoodId()
    {
        $prefix = 'FOOD';
        $latestFood = Food::latest('food_id')->first();

        if (!$latestFood) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestFood->food_id, 4);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }
}
