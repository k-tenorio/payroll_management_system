<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;

class AdminManageDeductionsController extends Controller
{
    public function index()
    {
        $deductions = Deduction::latest()->get();

        return view('admin.manage-deductions', compact('deductions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deduction_name' => 'required|string|max:255',
            'amount'         => 'required|numeric|min:0',
        ]);

        Deduction::create($request->only(['deduction_name', 'amount']));

        return redirect()->back()->with('success', 'Deduction added successfully.');
    }

    public function update(Request $request, $id)
    {
        $deduction = Deduction::findOrFail($id);

        $request->validate([
            'deduction_name' => 'required|string|max:255',
            'amount'         => 'required|numeric|min:0',
        ]);

        $deduction->update($request->only(['deduction_name', 'amount']));

        return redirect()->back()->with('success', 'Deduction updated successfully.');
    }

    public function destroy($id)
    {
        $deduction = Deduction::findOrFail($id);
        $deduction->delete();

        return redirect()->back()->with('success', 'Deduction deleted successfully.');
    }
}