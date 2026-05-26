<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip Records</title>

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

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow-x: auto;
        }

        .card-header {
            padding: 25px;
        }

        .card-header h2 {
            color: #1e293b;
            font-size: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1e293b;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 14px;
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
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
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
                <a href="{{ route('admin.manage-attendance.index') }}">Manage Attendance</a>
                <a href="{{ route('admin.manage-payroll.index') }}">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}">Position & Department</a>
                <a href="{{ route('admin.manage-payslips.index') }}" class="active">Payslips</a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="logout">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </aside>

        <main class="main-content">

            <div class="header">
                <h1>Payslip Records</h1>
                <p>View generated employee payslips</p>
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

            <div class="card">

                <div class="card-header">
                    <h2>Generated Payslips</h2>
                </div>

                <table>

                    <thead>
                        <tr>
                            <th>Payslip ID</th>
                            <th>Employee Name</th>
                            <th>Pay Period</th>
                            <th>Gross Pay</th>
                            <th>Total Deductions</th>
                            <th>Net Pay</th>
                            <th>Payroll Status</th>
                            <th>Generated Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($payslips as $payslip)

                        <tr>

                            <td>{{ $payslip->payslip_id }}</td>

                            <td>
                                {{ optional($payslip->employee->user)->name ?? '—' }}
                            </td>

                            <td>

                                @if($payslip->payroll)

                                {{ date('M d, Y', strtotime($payslip->payroll->pay_period_start)) }}
                                -
                                {{ date('M d, Y', strtotime($payslip->payroll->pay_period_end)) }}

                                @else

                                —

                                @endif

                            </td>

                            <td>
                                ₱{{ number_format(optional($payslip->payroll)->gross_pay ?? 0, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format(optional($payslip->payroll)->total_deductions ?? 0, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format(optional($payslip->payroll)->net_pay ?? 0, 2) }}
                            </td>

                            <td>
                                <span class="status">
                                    {{ optional($payslip->payroll)->payroll_status ?? '—' }}
                                </span>
                            </td>

                            <td>
                                {{ date('M d, Y', strtotime($payslip->payslip_date)) }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="empty-row">
                                No paid payslips found.
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