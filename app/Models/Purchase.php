<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $primaryKey = 'purchase_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'purchase_id',
        'material_id',
        'supplier_id',
        'date',
        'qty',
        'unit_price',
        'total_amount',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->purchase_id = $model->generatePurchaseId();
        });

        static::saving(function ($purchase) {
            $purchase->calculateTotal();
        });
    }

    private function generatePurchaseId()
    {
        $prefix = 'PUR';
        $latestPurchase = Purchase::latest('purchase_id')->first();

        if (!$latestPurchase) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestPurchase->purchase_id, 3);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }

    public function calculateTotal(): void
    {
        $this->total_amount = $this->qty * $this->unit_price;
    }
}
