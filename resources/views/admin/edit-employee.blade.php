<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>

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
            display: flex;
            flex-direction: column;
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

        .logout {
            margin-top: auto;
        }

        .logout button {
            display: block;
            width: 100%;
            color: white;
            padding: 13px 15px;
            border-radius: 10px;
            background: #dc2626;
            border: none;
            text-align: left;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .logout button:hover {
            background: #b91c1c;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            margin-left: 18px;
        }

        .form-box {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 30px;
            max-width: 900px;
        }

        .form-box h2 {
            color: #1e293b;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .section-label {
            grid-column: 1 / -1;
            font-size: 13px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        .divider {
            grid-column: 1 / -1;
            border: none;
            border-top: 1px solid #e2e8f0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
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

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .save-btn {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .cancel-btn {
            background: #e2e8f0;
            color: #334155;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .cancel-btn:hover {
            background: #cbd5e1;
        }

        .logout { margin-top: auto; }
        .logout button {
            display: block;
            width: 100%;
            color: #ffffff;
            padding: 13px 15px;
            border-radius: 8px;
            background: #dc2626;
            border: none;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .logout button:hover { background: #b91c1c; }
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
                <a href="{{ route('admin.manage-employees.index') }}" class="active">Manage Employees</a>
                <a href="{{ route('admin.manage-attendance.index') }}">Manage Attendance</a>
                <a href="{{ route('admin.manage-payroll.index') }}">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}">Position & Department</a>
                <a href="{{ route('admin.manage-payslips.index') }}">Payslips</a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="logout">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </aside>

        <main class="main-content">

            <div class="header">
                <h1>Edit Employee</h1>
                <p>Update employee information</p>
            </div>

            @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-box">

                <h2>Edit Employee Details</h2>

                <p class="subtitle">
                    Update the information below.
                </p>

                <form action="{{ route('admin.manage-employees.update', $employee->employee_id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="section-label">
                            Account Information
                        </div>

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text"
                                name="name"
                                value="{{ old('name', $employee->user->name) }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                value="{{ old('email', $employee->user->email) }}"
                                required>
                        </div>

                        <hr class="divider">

                        <div class="section-label">
                            Job Information
                        </div>

                        @php
                        $groupedPositions = $positions->groupBy(function ($item) {
                        return optional($item->department)->department_name ?? 'Other';
                        });
                        @endphp

                        <div class="form-group">
                            <label>Position</label>

                            <select name="position" required>

                                <option value="" disabled>
                                    Select Position
                                </option>

                                @foreach($groupedPositions as $departmentName => $departmentPositions)

                                <optgroup label="{{ $departmentName }}">

                                    @foreach($departmentPositions as $position)

                                    <option value="{{ $position->position_name }}"
                                        {{ old('position', $employee->position) == $position->position_name ? 'selected' : '' }}>

                                        {{ $position->position_name }}

                                    </option>

                                    @endforeach

                                </optgroup>

                                @endforeach

                            </select>

                        </div>

                        <hr class="divider">

                        <div class="section-label">
                            Contact Information
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text"
                                name="contact_number"
                                value="{{ old('contact_number', $employee->contact_number) }}"
                                placeholder="Contact Number">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text"
                                name="address"
                                value="{{ old('address', $employee->address) }}"
                                placeholder="Address">
                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="save-btn">
                            Save Changes
                        </button>

                        <a href="{{ route('admin.manage-employees.index') }}"
                            class="cancel-btn">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </main>

    </div>

</body>

</html>