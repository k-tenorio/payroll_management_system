<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>

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
            max-width: 95px;
            display: block;
            margin: 0 auto 12px;
            background: white;
            padding: 8px;
            border-radius: 10px;
        }

        .logo h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 13px;
            color: #cbd5e1;
        }

        .menu a,
        .logout button {
            display: block;
            width: 100%;
            text-decoration: none;
            color: #e2e8f0;
            padding: 13px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            background: none;
            border: none;
            text-align: left;
            font-size: 15px;
            cursor: pointer;
        }

        .menu a:hover,
        .menu .active {
            background: #1e293b;
        }

        .logout {
            margin-top: 25px;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 22px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header h1 {
            font-size: 26px;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .header p {
            color: #64748b;
            font-size: 15px;
        }

        .cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card h3 {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 12px;
            font-weight: normal;
        }

        .card h2 {
            font-size: 28px;
            color: #0f172a;
        }

        .amount {
            color: #166534;
        }

        .deduction {
            color: #b91c1c;
        }

        .net {
            color: #1d4ed8;
        }
    </style>
</head>

<body>

    <div class="dashboard">

        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/payroll_logo.png') }}" alt="Payroll Logo">
                <h2>Staff Panel</h2>
                <p>Payroll Management System</p>
            </div>

            <div class="menu">
                <a href="{{ route('staff.dashboard') }}" class="active">Dashboard</a>
                <a href="{{ route('staff.attendance') }}">Attendance</a>
                <a href="{{ route('staff.payslips') }}">Payslips</a>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="logout">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>

        <div class="main">

            <div class="header">
                <h1>Dashboard</h1>
                <p>Welcome back, {{ auth()->user()->name }}</p>
            </div>

            <div class="cards">

                <div class="row">
                    <div class="card">
                        <h3>Total Salary Earned</h3>
                        <h2 class="amount">₱{{ number_format($totalSalaryEarned ?? 0, 2) }}</h2>
                    </div>

                    <div class="card">
                        <h3>Total Deductions</h3>
                        <h2 class="deduction">₱{{ number_format($totalDeductions ?? 0, 2) }}</h2>
                    </div>

                    <div class="card">
                        <h3>Net Total Earnings</h3>
                        <h2 class="net">₱{{ number_format($netTotalEarnings ?? 0, 2) }}</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="card">
                        <h3>Present (This Month)</h3>
                        <h2>{{ $attendanceThisMonth ?? 0 }}</h2>
                    </div>

                    <div class="card">
                        <h3>Absence (This Month)</h3>
                        <h2>{{ $absenceThisMonth ?? 0 }}</h2>
                    </div>

                    <div class="card">
                        <h3>Late (This Month)</h3>
                        <h2>{{ $lateThisMonth ?? 0 }}</h2>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>