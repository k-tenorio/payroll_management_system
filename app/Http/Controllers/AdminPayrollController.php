<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->where('employment_status', 'Active')->get();

        $payrolls = Payroll::with('employee.user')
            ->where('payroll_status', 'pending')    
            ->orderBy('pay_period_start', 'desc')
            ->get();

        return view('admin.manage-payroll', compact('employees', 'payrolls'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'month'       => 'required|numeric|min:1|max:12',
            'year'        => 'required|numeric|min:2020|max:2100',
        ]);

        $employee = Employee::with('salary')->findOrFail($request->employee_id);

        if (!$employee->salary) {
            return back()->with('error', 'This employee has no salary record.');
        }

        $payPeriodStart = Carbon::create($request->year, $request->month, 1)->startOfMonth();
        $payPeriodEnd   = Carbon::create($request->year, $request->month, 1)->endOfMonth();

        $existingPayroll = Payroll::where('employee_id', $employee->employee_id)
            ->where('pay_period_start', $payPeriodStart->toDateString())
            ->where('pay_period_end', $payPeriodEnd->toDateString())
            ->first();

        if ($existingPayroll) {
            return back()->with('error', 'Payroll already generated for this employee and month.');
        }

        $basicSalary = $employee->salary->basic_salary;

        // Get all global deductions and sum them
        $deductions      = Deduction::all();
        $totalDeductions = $deductions->sum('amount');

        $grossPay = $basicSalary;
        $netPay   = $grossPay - $totalDeductions;

        $payroll = Payroll::create([
            'employee_id'      => $employee->employee_id,
            'pay_period_start' => $payPeriodStart->toDateString(),
            'pay_period_end'   => $payPeriodEnd->toDateString(),
            'basic_salary'     => $basicSalary,
            'total_deductions' => $totalDeductions,
            'gross_pay'        => $grossPay,
            'net_pay'          => $netPay,
            'payroll_status'   => 'Pending',
        ]);

        Payslip::create([
            'payroll_id'   => $payroll->payroll_id,
            'employee_id'  => $employee->employee_id,
            'payslip_date' => now()->toDateString(),
        ]);

        return back()->with('success', 'Monthly payroll generated successfully.');
    }

    public function markAsPaid(Payroll $payroll)
    {
        $payroll->update([
            'payroll_status' => 'Paid',
        ]);

        return back()->with('success', 'Payroll marked as paid.');
    }

    public function payslipIndex()
    {
        $payslips = Payslip::with(['employee.user', 'payroll'])
            ->whereHas('payroll', function ($query) {
                $query->where('payroll_status', 'Paid');
            })
            ->orderBy('payslip_date', 'desc')
            ->get();

        return view('admin.manage-payslips', compact('payslips'));
    }
}
