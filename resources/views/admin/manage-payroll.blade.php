<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management</title>

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

        /* CARDS */

        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 25px;
            margin-bottom: 30px;
        }

        .card h2 {
            color: #1e293b;
            font-size: 20px;
            margin-bottom: 20px;
        }

        /* ALERTS */

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #bbf7d0;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #fecaca;
            margin-bottom: 20px;
        }

        /* FORM */

        .form-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 15px;
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

        .generate-btn {
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .generate-btn:hover {
            background: #1d4ed8;
        }

        /* TABLE */

        .table-box {
            overflow-x: auto;
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
            display: inline-block;
        }

        .pending-status {
            background: #fef3c7;
            color: #92400e;
        }

        .paid-status {
            background: #dcfce7;
            color: #166534;
        }

        /* BUTTONS */

        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 13px;
            cursor: pointer;
            font-weight: 600;
        }

        .paid-btn {
            background: #22c55e;
        }

        .paid-btn:hover {
            background: #16a34a;
        }

        .paid-text {
            color: #16a34a;
            font-weight: 600;
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
                <a href="{{ route('admin.manage-employees.index') }}">Manage Employees</a>
                <a href="{{ route('admin.manage-attendance.index') }}">Manage Attendance</a>
                <a href="{{ route('admin.manage-payroll.index') }}" class="active">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}">Position & Department</a>
                <a href="{{ route('admin.manage-payslips.index') }}">Payslips</a>
                <a href="{{ url('/') }}">Logout</a>
            </nav>

        </aside>

        <main class="main-content">

            <div class="header">
                <h1>Payroll Management</h1>
                <p>Generate and manage employee payroll records</p>
            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- GENERATE PAYROLL -->

            <div class="card">

                <h2>Generate Monthly Payroll</h2>

                <form action="{{ route('admin.manage-payroll.generate') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <select name="employee_id" required>

                            <option value="">Select Employee</option>

                            @foreach($employees as $employee)

                                <option value="{{ $employee->employee_id }}">
                                    {{ $employee->user->name }} - {{ $employee->position }}
                                </option>

                            @endforeach

                        </select>

                        <select name="month" required>

                            <option value="">Month</option>

                            @for($m = 1; $m <= 12; $m++)

                                <option value="{{ $m }}">
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>

                            @endfor

                        </select>

                        <input type="number"
                               name="year"
                               value="{{ date('Y') }}"
                               required>

                        <button type="submit" class="generate-btn">
                            Generate
                        </button>

                    </div>

                </form>

            </div>

            <!-- PAYROLL TABLE -->

            <div class="card table-box">

                <h2>Payroll Records</h2>

                <table>

                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Pay Period</th>
                            <th>Basic Salary</th>
                            <th>Deductions</th>
                            <th>Gross Pay</th>
                            <th>Net Pay</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($payrolls as $payroll)

                        <tr>

                            <td>
                                {{ $payroll->employee->user->name }}
                            </td>

                            <td>
                                {{ date('M d, Y', strtotime($payroll->pay_period_start)) }}
                                -
                                {{ date('M d, Y', strtotime($payroll->pay_period_end)) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->basic_salary, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->total_deductions, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->gross_pay, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->net_pay, 2) }}
                            </td>

                            <td>

                                <span class="status 
                                    {{ $payroll->payroll_status === 'Paid' ? 'paid-status' : 'pending-status' }}">

                                    {{ $payroll->payroll_status }}

                                </span>

                            </td>

                            <td>

                                @if($payroll->payroll_status === 'Pending')

                                    <form action="{{ route('admin.manage-payroll.mark-paid', $payroll->payroll_id) }}"
                                          method="POST"
                                          style="margin:0;">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn paid-btn">
                                            Mark as Paid
                                        </button>

                                    </form>

                                @else

                                    <span class="paid-text">
                                        Paid
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="empty-row">
                                No payroll records found.
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