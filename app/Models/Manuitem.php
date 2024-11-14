<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manuitem extends Model
{
    use HasFactory;

    protected $table = 'manuitems';
    protected $primaryKey = 'manu_id';
    public $incrementing = false;
    protected $keytype = 'string';

    protected $fillable = [
        'manu_id',
        'item_id',
        'qty',
        'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->manu_id = self::generateManuId();
        });
    }

    public static function generateManuId()
    {
        $prefix = 'MANU';
        $latestRecord = self::orderBy('manu_id', 'desc')->first();
        $latestId = $latestRecord ? intval(substr($latestRecord->manu_id, strlen($prefix))) : 0;

        return $prefix . str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);
    }

    public function handlist()
    {
        return $this->belongsTo(Handlist::class, 'item_id', 'item_id');
    }
}
