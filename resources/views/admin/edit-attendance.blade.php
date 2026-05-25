<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #0f172a;
            color: white;
            padding: 25px 18px;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo img {
            max-width: 100px;
            display: block;
            margin: 0 auto 12px;
            background: white;
            padding: 10px;
            border-radius: 15px;
        }

        .logo p {
            font-size: 13px;
            color: #cbd5e1;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #e2e8f0;
            padding: 13px 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: 0.2s;
            font-size: 15px;
        }

        .menu a:hover {
            background: #1e293b;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            color: #1e293b;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 30px;
            max-width: 750px;
        }

        .card h2 {
            color: #1e293b;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .card-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            margin-left: 18px;
            margin-top: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
        }

        .field-error {
            color: #dc2626;
            font-size: 12px;
        }

        .input-error {
            border-color: #dc2626 !important;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .save-btn {
            background: #2563eb;
            color: white;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .cancel-btn {
            background: #e2e8f0;
            color: #334155;
        }

        .cancel-btn:hover {
            background: #cbd5e1;
        }
    </style>
</head>

<body>

    <div class="dashboard">

        <aside class="sidebar">

            <div class="logo">
                <img src="{{ asset('images/payroll_logo.png') }}" alt="Payroll Logo">
                <p>Admin Panel</p>
            </div>

            <nav class="menu">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.manage-employees.index') }}">Manage Employees</a>
                <a href="{{ route('admin.manage-attendance.index') }}" class="active">Manage Attendance</a>
                <a href="{{ route('admin.manage-payroll.index') }}">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}">Position & Department</a>
                <a href="{{ route('admin.manage-payslips.index') }}">Payslips</a>
                <a href="{{ url('/') }}">Logout</a>
            </nav>

        </aside>

        <main class="main-content">

            <div class="header">
                <h1>Edit Attendance</h1>
                <p>Update employee attendance information</p>
            </div>

            @if ($errors->any())
            <div class="alert-error">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">

                <h2>Attendance Record</h2>

                <p class="card-subtitle">
                    Update attendance details and save changes.
                </p>

                <form action="{{ route('admin.manage-attendance.update', $attendance->attendance_id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group full-width">

                            <label for="employee_id">
                                Employee
                            </label>

                            <select name="employee_id"
                                id="employee_id"
                                required
                                class="{{ $errors->has('employee_id') ? 'input-error' : '' }}">

                                <option value="">
                                    Select Employee
                                </option>

                                @foreach ($employees as $employee)

                                <option value="{{ $employee->employee_id }}"
                                    {{ old('employee_id', $attendance->employee_id) == $employee->employee_id ? 'selected' : '' }}>

                                    {{ $employee->user->name }}

                                </option>

                                @endforeach

                            </select>

                            @error('employee_id')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="attendance_date">
                                Attendance Date
                            </label>

                            <input type="date"
                                name="attendance_date"
                                id="attendance_date"
                                value="{{ old('attendance_date', $attendance->attendance_date) }}"
                                required
                                class="{{ $errors->has('attendance_date') ? 'input-error' : '' }}">

                            @error('attendance_date')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="status">
                                Status
                            </label>

                            <select name="status"
                                id="status"
                                required
                                class="{{ $errors->has('status') ? 'input-error' : '' }}">

                                <option value="">
                                    Select Status
                                </option>

                                <option value="Present"
                                    {{ old('status', $attendance->status) === 'Present' ? 'selected' : '' }}>
                                    Present
                                </option>

                                <option value="Late"
                                    {{ old('status', $attendance->status) === 'Late' ? 'selected' : '' }}>
                                    Late
                                </option>

                                <option value="Absent"
                                    {{ old('status', $attendance->status) === 'Absent' ? 'selected' : '' }}>
                                    Absent
                                </option>

                            </select>

                            @error('status')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="time_in">
                                Time In
                            </label>

                            <input type="time"
                                name="time_in"
                                id="time_in"
                                value="{{ old('time_in', $attendance->time_in) }}"
                                required
                                class="{{ $errors->has('time_in') ? 'input-error' : '' }}">

                            @error('time_in')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="time_out">
                                Time Out
                            </label>

                            <input type="time"
                                name="time_out"
                                id="time_out"
                                value="{{ old('time_out', $attendance->time_out) }}"
                                class="{{ $errors->has('time_out') ? 'input-error' : '' }}">

                            @error('time_out')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn save-btn">
                            Update Attendance
                        </button>

                        <a href="{{ route('admin.manage-attendance.index') }}"
                            class="btn cancel-btn">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </main>

    </div>

</body>

</html>