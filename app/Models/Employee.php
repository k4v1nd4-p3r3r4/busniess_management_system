<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'date_of_birth',
        'hire_date',
        'department',
        'position',
        'base_salary',
        'daily_wage',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        // Automatically generate employee_id when creating a new employee
        static::creating(function ($model) {
            $model->employee_id = self::generateEmployeeId();
        });
    }

    private static function generateEmployeeId()
    {
        $lastEmployee = self::orderBy('employee_id', 'desc')->first();
        $lastId = $lastEmployee ? intval(substr($lastEmployee->employee_id, 3)) : 0;
        $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        return 'EMP' . $newId;
    }
}
