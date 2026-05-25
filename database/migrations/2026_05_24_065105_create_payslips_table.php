<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id('payslip_id');
            $table->foreignId('payroll_id')->constrained('payroll', 'payroll_id')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees', 'employee_id')->cascadeOnDelete();
            $table->date('payslip_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
