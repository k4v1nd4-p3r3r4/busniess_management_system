<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemsale extends Model
{
    use HasFactory;

    protected $primaryKey = 'sale_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'item_id',
        'customer_id',
        'date',
        'qty',
        'unit_price',
        'total_amount',
    ];

    public function handlist()
    {
        return $this->belongsTo(Handlist::class, 'item_id', 'item_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

      // Automatically calculate total_amount when qty or unit_price is updated
      public function setQtyAttribute($value)
      {
          $this->attributes['qty'] = $value;
          $this->calculateTotalAmount();
      }

      public function setUnitPriceAttribute($value)
      {
          $this->attributes['unit_price'] = $value;
          $this->calculateTotalAmount();
      }

      protected function calculateTotalAmount()
      {
          $this->attributes['total_amount'] = $this->qty * $this->unit_price;
      }

}
