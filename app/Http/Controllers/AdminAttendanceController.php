<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee.user')->get();
        $employees = Employee::with('user')->get();

        return view('admin.manage-attendance', compact('attendances', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,employee_id',
            'attendance_date' => 'required|date',
            'time_in'         => 'required',
            'time_out'        => 'nullable',
            'status'          => 'required|in:Present,Late,Absent',
        ]);

        Attendance::create($request->only([
            'employee_id',
            'attendance_date',
            'time_in',
            'time_out',
            'status',
        ]));

        return redirect()->route('admin.manage-attendance.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees  = Employee::with('user')->get();

        return view('admin.edit-attendance', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,employee_id',
            'attendance_date' => 'required|date',
            'time_in'         => 'required',
            'time_out'        => 'nullable',
            'status'          => 'required|in:Present,Late,Absent',
        ]);

        $attendance = Attendance::findOrFail($id);

        $attendance->update($request->only([
            'employee_id',
            'attendance_date',
            'time_in',
            'time_out',
            'status',
        ]));

        return redirect()->route('admin.manage-attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();

        return redirect()->route('admin.manage-attendance.index')
            ->with('success', 'Attendance deleted.');
    }
}
