<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialUsage extends Model
{
    use HasFactory;
    protected $primaryKey = 'usage_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'usage_id',
        'material_id',
        'date',
        'usage_qty',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->usage_id = $model->generateUsageId();
        });
    }

    private function generateUsageId()
    {
        $prefix = 'USE';
        $latestUsage = MaterialUsage::latest('usage_id')->first();

        if (!$latestUsage) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestUsage->usage_id, 3);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'material_id');
    }
}
