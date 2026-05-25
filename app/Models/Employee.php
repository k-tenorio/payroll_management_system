<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'user_id',
        'position',
        'department',
        'contact_number',
        'address',
        'date_hired',
        'employment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function salary()
    {
        return $this->hasOne(Salary::class, 'employee_id');
    }

    public function deductions()
    {
        return $this->hasOne(Deduction::class, 'employee_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class, 'employee_id');
    }
}