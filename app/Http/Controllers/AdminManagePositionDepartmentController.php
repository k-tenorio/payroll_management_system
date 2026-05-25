<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class AdminManagePositionDepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $positions = Position::with('department')->get();

        return view('admin.manage-position-department', compact('departments', 'positions'));
    }

    public function storeDepartment(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
        ]);

        Department::create([
            'department_name' => $request->department_name,
        ]);

        return redirect()->back()->with('success', 'Department added successfully.');
    }

    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);

        $department->update([
            'department_name' => $request->department_name,
        ]);

        return redirect()->back()->with('success', 'Department updated successfully.');
    }

    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('success', 'Department deleted successfully.');
    }

    public function storePosition(Request $request)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,department_id',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        Position::create([
            'position_name' => $request->position_name,
            'department_id' => $request->department_id,
            'basic_salary' => $request->basic_salary,
        ]);

        return redirect()->back()->with('success', 'Position added successfully.');
    }

    public function updatePosition(Request $request, $id)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,department_id',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        $position = Position::findOrFail($id);

        $position->update([
            'position_name' => $request->position_name,
            'department_id' => $request->department_id,
            'basic_salary' => $request->basic_salary,
        ]);

        return redirect()->back()->with('success', 'Position updated successfully.');
    }

    public function deletePosition($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->back()->with('success', 'Position deleted successfully.');
    }
}