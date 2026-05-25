<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employee</title>

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

        /* SIDEBAR */

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

        .logo h2 {
            font-size: 24px;
            margin-bottom: 5px;
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

        /* MAIN CONTENT */

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 25px;
        }

        /* FORM */

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }

        .form-box h2 {
            margin-bottom: 20px;
            color: #1e293b;
            font-size: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .submit-group {
            grid-column: 1 / -1;
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
            margin-top: 18px;
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

        /* TABLE */

        .table-box {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
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

        /* STATUS */

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .active-status {
            background: #dcfce7;
            color: #166534;
        }

        .inactive-status {
            background: #fee2e2;
            color: #991b1b;
        }

        /* ACTION BUTTONS */

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

        .deactivate-btn {
            background: #f97316;
        }

        .deactivate-btn:hover {
            background: #ea580c;
        }

        .activate-btn {
            background: #22c55e;
        }

        .activate-btn:hover {
            background: #16a34a;
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
                <a href="{{ url('/') }}">Logout</a>
            </nav>
        </aside>

        <main class="main-content">

            <div class="header">
                <h1>Employee Management</h1>
            </div>

            <div class="form-box">
                <h2>Add Employee</h2>

                <form action="{{ route('admin.manage-employees.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">

                        <input type="text" name="name" placeholder="Employee Name" required>

                        <input type="email" name="email" placeholder="Email" required>

                        <input type="password" name="password" placeholder="Password" required>

                        @php
                        $groupedPositions = $positions->groupBy(function ($item) {
                        return optional($item->department)->department_name ?? 'Other';
                        });
                        @endphp

                        <select name="position" required>
                            <option value="" disabled selected>Select Position</option>

                            @foreach($groupedPositions as $departmentName => $departmentPositions)
                            <optgroup label="{{ $departmentName }}">
                                @foreach($departmentPositions as $position)
                                <option value="{{ $position->position_name }}">
                                    {{ $position->position_name }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>

                        <input type="text" name="contact_number" placeholder="Contact Number">

                        <input type="text" name="address" placeholder="Address">

                    </div>

                    <div class="submit-group">
                        <button type="submit" class="save-btn">
                            Save Employee
                        </button>
                    </div>

                </form>
            </div>

            <div class="table-box">

                <table>

                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Date Hired</th>
                            <th>Basic Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($employees as $employee)

                        <tr>

                            <td>{{ $employee->user->name }}</td>

                            <td>{{ $employee->user->email }}</td>

                            <td>{{ $employee->position }}</td>

                            <td>{{ $employee->department }}</td>

                            <td>{{ $employee->contact_number ?? '—' }}</td>

                            <td>{{ $employee->address ?? '—' }}</td>

                            <td>
                                {{ $employee->date_hired ? \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') : '—' }}
                            </td>

                            <td>
                                ₱{{ number_format($employee->salary->basic_salary ?? 0, 2) }}
                            </td>

                            <td>
                                <span class="status {{ $employee->employment_status == 'Active' ? 'active-status' : 'inactive-status' }}">
                                    {{ $employee->employment_status }}
                                </span>
                            </td>

                            <td>

                                <div class="actions">

                                    <a href="{{ route('admin.manage-employees.edit', $employee->employee_id) }}"
                                        class="btn edit-btn">
                                        Edit
                                    </a>

                                    @if($employee->employment_status === 'Active')

                                    <form action="{{ route('admin.manage-employees.deactivate', $employee->employee_id) }}"
                                        method="POST" style="display:inline;">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="btn deactivate-btn"
                                            onclick="return confirm('Deactivate this employee?')">

                                            Deactivate

                                        </button>

                                    </form>

                                    @else

                                    <form action="{{ route('admin.manage-employees.activate', $employee->employee_id) }}"
                                        method="POST" style="display:inline;">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="btn activate-btn"
                                            onclick="return confirm('Activate this employee?')">

                                            Activate

                                        </button>

                                    </form>

                                    @endif

                                    <form action="{{ route('admin.manage-employees.destroy', $employee->employee_id) }}"
                                        method="POST" style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn delete-btn"
                                            onclick="return confirm('Delete this employee?')">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="10" class="empty-row">
                                No employees found.
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