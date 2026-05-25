<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManageEmployeeController;
use App\Http\Controllers\AdminManageDeductionsController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AdminPayrollController;
use App\Http\Controllers\AdminManagePositionDepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ADMIN */
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/manage-employees', [AdminManageEmployeeController::class, 'index'])->name('admin.manage-employees.index');
    Route::post('/admin/manage-employees', [AdminManageEmployeeController::class, 'store'])->name('admin.manage-employees.store');
    Route::get('/admin/manage-employees/{employee}/edit', [AdminManageEmployeeController::class, 'edit'])->name('admin.manage-employees.edit');
    Route::put('/admin/manage-employees/{employee}', [AdminManageEmployeeController::class, 'update'])->name('admin.manage-employees.update');
    Route::patch('/admin/manage-employees/{employee}/deactivate', [AdminManageEmployeeController::class, 'deactivate'])->name('admin.manage-employees.deactivate');
    Route::patch('/admin/manage-employees/{employee}/activate', [AdminManageEmployeeController::class, 'activate'])->name('admin.manage-employees.activate');
    Route::delete('/admin/manage-employees/{employee}', [AdminManageEmployeeController::class, 'destroy'])->name('admin.manage-employees.destroy');

    Route::get('/admin/manage-attendance', [AdminAttendanceController::class, 'index'])->name('admin.manage-attendance.index');
    Route::post('/admin/manage-attendance', [AdminAttendanceController::class, 'store'])->name('admin.manage-attendance.store');
    Route::get('/admin/manage-attendance/{attendance}/edit', [AdminAttendanceController::class, 'edit'])->name('admin.manage-attendance.edit');
    Route::put('/admin/manage-attendance/{attendance}', [AdminAttendanceController::class, 'update'])->name('admin.manage-attendance.update');
    Route::delete('/admin/manage-attendance/{attendance}', [AdminAttendanceController::class, 'destroy'])->name('admin.manage-attendance.destroy');

    Route::get('/admin/manage-payroll', [AdminPayrollController::class, 'index'])->name('admin.manage-payroll.index');
    Route::post('/admin/manage-payroll/generate', [AdminPayrollController::class, 'generate'])->name('admin.manage-payroll.generate');
    Route::patch('/admin/manage-payroll/{payroll}/mark-paid', [AdminPayrollController::class, 'markAsPaid'])->name('admin.manage-payroll.mark-paid');
    Route::get('/admin/manage-payslips', [AdminPayrollController::class, 'payslipIndex'])->name('admin.manage-payslips.index');

    Route::get('/admin/manage-deductions', [AdminManageDeductionsController::class, 'index'])->name('admin.manage-deductions.index');
    Route::post('/admin/manage-deductions', [AdminManageDeductionsController::class, 'store'])->name('admin.manage-deductions.store');
    Route::put('/admin/manage-deductions/{id}', [AdminManageDeductionsController::class, 'update'])->name('admin.manage-deductions.update');
    Route::delete('/admin/manage-deductions/{id}', [AdminManageDeductionsController::class, 'destroy'])->name('admin.manage-deductions.destroy');

    Route::get('/admin/manage-position-department', [AdminManagePositionDepartmentController::class, 'index'])->name('admin.manage-position-department.index');

    // Department Routes
    Route::post('/admin/manage-position-department/department', [AdminManagePositionDepartmentController::class, 'storeDepartment'])->name('admin.department.store');
    Route::put('/admin/manage-position-department/department/{id}', [AdminManagePositionDepartmentController::class, 'updateDepartment'])->name('admin.department.update');
    Route::delete('/admin/manage-position-department/department/{id}', [AdminManagePositionDepartmentController::class, 'deleteDepartment'])->name('admin.department.delete');
    // Position Routes
    Route::post('/admin/manage-position-department/position', [AdminManagePositionDepartmentController::class, 'storePosition'])->name('admin.position.store');
    Route::put('/admin/manage-position-department/position/{id}', [AdminManagePositionDepartmentController::class, 'updatePosition'])->name('admin.position.update');
    Route::delete('/admin/manage-position-department/position/{id}', [AdminManagePositionDepartmentController::class, 'deletePosition'])->name('admin.position.delete');
});




require __DIR__ . '/auth.php';
