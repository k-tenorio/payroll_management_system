<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management System</title>

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
            border-bottom: 1px solid rgba(255,255,255,0.1);
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

        .topbar {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .topbar h1 {
            color: #1e293b;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .topbar p {
            color: #64748b;
            font-size: 14px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card h3 {
            color: #1e293b;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card .number {
            font-size: 32px;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 8px;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
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
                <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
                <a href="{{ route('admin.manage-employees.index') }}">Manage Employees</a>
                <a href="{{ route('admin.manage-attendance.index') }}">Manage Attendance</a>
                <a href="{{ route('admin.manage-payroll.index') }}">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}">Position & Department</a>
                <a href="{{ route('admin.manage-payslips.index') }}">Payslips</a>
                <a href="{{ url('/') }}">Logout</a>
            </nav>

        </aside>

        <main class="main-content">

            <div class="topbar">
                <h1>Dashboard</h1>
                <p>Welcome to the Payroll Management System</p>
            </div>

            <div class="cards">

                <div class="card">
                    <div class="number">{{ $employeeCount }}</div>
                    <h3>Total Employees</h3>
                    <p>Registered employees in the system.</p>
                </div>

                <div class="card">
                    <div class="number">{{ $departmentCount }}</div>
                    <h3>Departments</h3>
                    <p>Total company departments available.</p>
                </div>

                <div class="card">
                    <div class="number">{{ $payrollCount }}</div>
                    <h3>Payroll Pending</h3>
                    <p>Pending payroll records in the system.</p>
                </div>

                <div class="card">
                    <div class="number">{{ $payslipCount }}</div>
                    <h3>Payslips</h3>
                    <p>Generated payslips for employees.</p>
                </div>

            </div>

        </main>

    </div>

</body>

</html>