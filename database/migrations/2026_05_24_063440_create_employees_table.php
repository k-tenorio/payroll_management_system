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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('position', 100)->nullable();
            $table->string('department', 100)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('date_hired')->nullable();
            $table->enum('employment_status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
