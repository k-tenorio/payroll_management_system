<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminManageEmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'salary'])->get();
        $positions = Position::with('department')->get();

        return view('admin.manage-employee', compact('employees', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:8',
            'position'       => 'required|string|exists:positions,position_name',
            'contact_number' => 'nullable|string|max:20',
            'address'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $position = Position::with('department')
                ->where('position_name', $request->position)
                ->firstOrFail();

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'employee',
            ]);

            $employee = Employee::create([
                'user_id'           => $user->id,
                'position'          => $position->position_name,
                'department'        => optional($position->department)->department_name,
                'contact_number'    => $request->contact_number,
                'address'           => $request->address,
                'date_hired'        => now(),
                'employment_status' => 'Active',
            ]);

            Salary::create([
                'employee_id'  => $employee->employee_id,
                'basic_salary' => $position->basic_salary,
            ]);
        });

        return redirect()->route('admin.manage-employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee)
    {
        $employee->load(['user', 'salary']);
        $positions = Position::with('department')->get();

        return view('admin.edit-employee', compact('employee', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $employee->user_id,
            'position'       => 'required|string|exists:positions,position_name',
            'contact_number' => 'nullable|string|max:20',
            'address'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $employee) {
            $position = Position::with('department')
                ->where('position_name', $request->position)
                ->firstOrFail();

            $employee->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $employee->update([
                'position'       => $position->position_name,
                'department'     => optional($position->department)->department_name,
                'contact_number' => $request->contact_number,
                'address'        => $request->address,
            ]);

            $employee->salary->update([
                'basic_salary' => $position->basic_salary,
            ]);
        });

        return redirect()->route('admin.manage-employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->user->delete();

        return redirect()->route('admin.manage-employees.index')->with('success', 'Employee deleted.');
    }

    public function deactivate(Employee $employee)
    {
        $employee->update([
            'employment_status' => 'Inactive',
        ]);

        return redirect()->route('admin.manage-employees.index')->with('success', 'Employee deactivated successfully.');
    }

    public function activate(Employee $employee)
    {
        $employee->update([
            'employment_status' => 'Active',
        ]);

        return redirect()->route('admin.manage-employees.index')->with('success', 'Employee activated successfully.');
    }
}
