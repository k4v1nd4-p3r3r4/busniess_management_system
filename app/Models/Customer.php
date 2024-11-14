<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'contact',
        'address',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->customer_id = $model->generateCustomerId();
        });
    }

    private function generateCustomerId()
    {
        $prefix = 'CUS';
        $latestCustomer = Customer::latest('customer_id')->first();

        if (!$latestCustomer) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestCustomer->customer_id, 3);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }
}
