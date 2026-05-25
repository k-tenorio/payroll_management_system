<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payroll';
    protected $primaryKey = 'payroll_id';

    protected $fillable = [
        'employee_id',
        'pay_period_start',
        'pay_period_end',
        'basic_salary',
        'total_deductions',
        'gross_pay',
        'net_pay',
        'payroll_status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function payslip()
    {
        return $this->hasOne(Payslip::class, 'payroll_id');
    }
}
