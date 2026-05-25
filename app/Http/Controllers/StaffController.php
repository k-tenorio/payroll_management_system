<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payroll;
use App\Models\Attendance;

class StaffController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Employee
        $employee = $user->employee;

        // Payroll Records (only include payrolls marked as Paid)
        $payrolls = Payroll::where('employee_id', $employee->employee_id)
            ->whereRaw('LOWER(payroll_status) = ?', ['paid'])
            ->get();

        // Totals
        $totalSalaryEarned = $payrolls->sum('gross_pay');

        $totalDeductions = $payrolls->sum('total_deductions');

        $netTotalEarnings = $payrolls->sum('net_pay');

        // Attendance This Month
        $attendanceThisMonth = Attendance::where('employee_id', $employee->employee_id)
            ->whereMonth('attendance_date', now()->month)
            ->whereYear('attendance_date', now()->year)
            ->where('status', 'Present')  // ← was 'attendance_status'
            ->count();

        // Absence This Month
        $absenceThisMonth = Attendance::where('employee_id', $employee->employee_id)
            ->whereMonth('attendance_date', now()->month)
            ->whereYear('attendance_date', now()->year)
            ->where('status', 'Absent')   // ← was 'attendance_status'
            ->count();

        // Late This Month
        $lateThisMonth = Attendance::where('employee_id', $employee->employee_id)
            ->whereMonth('attendance_date', now()->month)
            ->whereYear('attendance_date', now()->year)
            ->where('status', 'Late')     // ← was 'attendance_status'
            ->count();

        return view('staff.dashboard', compact(
            'totalSalaryEarned',
            'totalDeductions',
            'netTotalEarnings',
            'attendanceThisMonth',
            'absenceThisMonth',
            'lateThisMonth'
        ));
    }

    public function attendance()
    {
        $user = Auth::user();
        $employee = $user->employee;

        $attendances = Attendance::where('employee_id', $employee->employee_id)
            ->whereMonth('attendance_date', now()->month)
            ->whereYear('attendance_date', now()->year)
            ->orderBy('attendance_date', 'desc')
            ->get();

        $attendanceThisMonth = $attendances->where('status', 'Present')->count();
        $absenceThisMonth = $attendances->where('status', 'Absent')->count();
        $lateThisMonth = $attendances->where('status', 'Late')->count();

        return view('staff.attendance', compact(
            'attendances',
            'attendanceThisMonth',
            'absenceThisMonth',
            'lateThisMonth'
        ));
    }

    public function payslips()
    {
        $user = Auth::user();
        $employee = $user->employee;

        $payslips = \App\Models\Payslip::with('payroll')
            ->where('employee_id', $employee->employee_id)
            ->whereHas('payroll', function ($query) {
                $query->whereRaw('LOWER(payroll_status) = ?', ['paid']);
            })
            ->orderBy('payslip_date', 'desc')
            ->get();

        return view('staff.payslips', compact('payslips'));
    }
}
