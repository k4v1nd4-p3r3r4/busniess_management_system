<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $primaryKey = 'material_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'material_id',
        'material_name',
        'category',
        'initial_qty',
        'unit',
        'available_qty',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->material_id = $model->generateMaterialId();
        });
    }

    private function generateMaterialId()
    {
        $prefix = 'MAT';
        $latestMaterial = Material::latest('material_id')->first();

        if (!$latestMaterial) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestMaterial->material_id, 3);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }
}
