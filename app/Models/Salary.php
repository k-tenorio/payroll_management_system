<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $primaryKey = 'salary_id';

    protected $fillable = [
        'employee_id',
        'basic_salary',
        'hourly_rate',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}