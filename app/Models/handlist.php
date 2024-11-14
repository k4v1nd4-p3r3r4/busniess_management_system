<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class handlist extends Model
{
    use HasFactory;

    protected $table = 'handlists';
    protected $primaryKey = 'item_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'item_id',
        'item_name',

        'unit',
        'qty'


    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->item_id = $model->generateItemId();
        });
    }

    private function generateItemId()
    {
        $prefix = 'ITM';
        $latestItem = Handlist::latest('item_id')->first();

        if (!$latestItem) {
            return $prefix . '001';
        }

        $lastId = (int)substr($latestItem->item_id, 3);
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);
    }

    public function manuitems()
    {
        return $this->hasMany(Manuitem::class, 'item_id', 'item_id');
    }
}
