<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Payslip;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'employeeCount' => Employee::count(),
            'departmentCount' => Department::count(),
            'payrollCount' => Payroll::where('payroll_status', 'Pending')->count(),
            'payslipCount' => Payslip::count(),
        ]);
    }
}
