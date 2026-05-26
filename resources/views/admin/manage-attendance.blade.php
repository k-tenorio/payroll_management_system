    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Admin Attendance</title>

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

            .form-box,
            .table-box {
                background: white;
                border-radius: 12px;
                border: 1px solid #e2e8f0;
                margin-bottom: 30px;
            }

            .form-box {
                padding: 25px;
            }

            .form-box h2,
            .table-title {
                color: #1e293b;
                font-size: 20px;
                margin-bottom: 20px;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }

            .field-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .field-group label {
                color: #475569;
                font-size: 13px;
                font-weight: 600;
            }

            .submit-group {
                grid-column: 1 / -1;
                align-items: flex-end;
                display: flex;
                justify-content: flex-end;
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

            .save-btn {
                background: #2563eb;
                color: white;
                padding: 12px 18px;
                border: none;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
            }

            .save-btn:hover {
                background: #1d4ed8;
            }

            .alert-success {
                background: #dcfce7;
                color: #166534;
                padding: 12px 16px;
                border-radius: 8px;
                margin-bottom: 20px;
                border: 1px solid #bbf7d0;
            }

            .error-box {
                color: #991b1b;
                background: #fee2e2;
                border: 1px solid #fecaca;
                padding: 12px 16px;
                border-radius: 8px;
                margin-top: 15px;
            }

            .error-box ul {
                margin-left: 18px;
            }

            .table-box {
                overflow-x: auto;
            }

            .table-header {
                padding: 25px 25px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th {
                background: #1e293b;
                color: white;
                padding: 15px;
                font-size: 14px;
                text-align: left;
            }

            td {
                padding: 15px;
                border-bottom: 1px solid #e2e8f0;
                font-size: 14px;
                color: #334155;
            }

            tr:hover {
                background: #f8fafc;
            }

            .status {
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
            }

            .present-status {
                background: #dcfce7;
                color: #166534;
            }

            .late-status {
                background: #fef3c7;
                color: #92400e;
            }

            .absent-status {
                background: #fee2e2;
                color: #991b1b;
            }

            .actions {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .btn {
                padding: 8px 14px;
                border: none;
                border-radius: 6px;
                color: white;
                font-size: 13px;
                cursor: pointer;
                text-decoration: none;
                font-weight: 600;
            }

            .edit-btn {
                background: #facc15;
                color: #1e293b;
            }

            .edit-btn:hover {
                background: #eab308;
            }

            .delete-btn {
                background: #dc2626;
            }

            .delete-btn:hover {
                background: #b91c1c;
            }

            .empty-row {
                text-align: center;
                padding: 20px;
                color: #64748b;
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
                    <a href="{{ route('admin.manage-employees.index') }}">Manage Employees</a>
                    <a href="{{ route('admin.manage-attendance.index') }}" class="active">Manage Attendance</a>
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
                    <h1>Attendance Management</h1>
                    <p>Record and manage employee attendance</p>
                </div>

                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-box">
                    <h2>Add Attendance</h2>

                    <form action="{{ route('admin.manage-attendance.store') }}" method="POST">
                        @csrf

                        <div class="form-grid">

                            <div class="field-group">
                                <label for="employee_id">Employee</label>
                                <select id="employee_id" name="employee_id" required>
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->employee_id }}">
                                            {{ $employee->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field-group">
                                <label for="attendance_date">Attendance Date</label>
                                <input id="attendance_date" type="date" name="attendance_date" value="{{ old('attendance_date') }}" required>
                            </div>

                            <div class="field-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Present">Present</option>
                                    <option value="Late">Late</option>
                                    <option value="Absent">Absent</option>
                                </select>
                            </div>

                            <div class="field-group">
                                <label for="time_in">Time In</label>
                                <input id="time_in" type="time" name="time_in" value="{{ old('time_in') }}" required>
                            </div>

                            <div class="field-group">
                                <label for="time_out">Time Out</label>
                                <input id="time_out" type="time" name="time_out" value="{{ old('time_out') }}">
                            </div>

                            <div class="field-group submit-group">
                                <button type="submit" class="save-btn">
                                    Save Attendance
                                </button>
                            </div>

                        </div>

                        @if ($errors->any())
                            <div class="error-box">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </form>
                </div>

                <div class="table-box">

                    <div class="table-header">
                        <h2 class="table-title">Attendance Records</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Attendance ID</th>
                                <th>Employee Name</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->attendance_id }}</td>
                                    <td>{{ $attendance->employee->user->name ?? 'N/A' }}</td>
                                    <td>{{ $attendance->attendance_date }}</td>
                                    <td>{{ $attendance->time_in }}</td>
                                    <td>{{ $attendance->time_out ?? '—' }}</td>

                                    <td>
                                        <span class="status 
                                            @if($attendance->status == 'Present') present-status
                                            @elseif($attendance->status == 'Late') late-status
                                            @else absent-status
                                            @endif">
                                            {{ $attendance->status }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="actions">

                                            <a href="{{ route('admin.manage-attendance.edit', $attendance->attendance_id) }}"
                                            class="btn edit-btn">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.manage-attendance.destroy', $attendance->attendance_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this record?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn delete-btn">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="empty-row">
                                        No attendance records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </main>

        </div>

    </body>

    </html>
