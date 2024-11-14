<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'supplier_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'supplier_id',
        'supplier_name',
        'contact_number',
        'address',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->supplier_id = $model->generateSupplierId();
        });
    }

    private function generateSupplierId()
    {
        $prefix = 'SUP';
        $latestSupplier = Supplier::latest('supplier_id')->first();

        if (!$latestSupplier) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestSupplier->supplier_id, 3);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }
}
