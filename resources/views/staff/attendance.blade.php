<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Attendance</title>

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
            margin-top: auto;
        }

        .logout button {
            background: #dc2626;
            color: white;
            font-weight: 600;
        }

        .logout button:hover {
            background: #b91c1c;
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
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
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

        .present {
            color: #047857;
        }

        .absent {
            color: #b91c1c;
        }

        .late {
            color: #b45309;
        }

        .table-box {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            overflow-x: auto;
        }

        .table-title {
            font-size: 20px;
            color: #0f172a;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #0f172a;
            color: white;
            font-weight: normal;
        }

        tr:hover {
            background: #f8fafc;
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-present {
            background: #dcfce7;
            color: #166534;
        }

        .status-absent {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-late {
            background: #fef3c7;
            color: #92400e;
        }

        .empty-state {
            padding: 30px;
            text-align: center;
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
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/payroll_logo.png') }}" alt="Payroll Logo">
                <h2>Staff Panel</h2>
                <p>Payroll Management System</p>
            </div>

            <div class="menu">
                <a href="{{ route('staff.dashboard') }}">Dashboard</a>
                <a href="{{ route('staff.attendance') }}" class="active">Attendance</a>
                <a href="{{ route('staff.payslips') }}">Payslips</a>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="logout">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>

        <div class="main">
            <div class="header">
                <h1>Attendance This Month</h1>
                <p>Review your attendance records for {{ now()->format('F Y') }}.</p>
            </div>

            <div class="cards">
                <div class="card">
                    <h3>Present</h3>
                    <h2 class="present">{{ $attendanceThisMonth ?? 0 }}</h2>
                </div>
                <div class="card">
                    <h3>Absent</h3>
                    <h2 class="absent">{{ $absenceThisMonth ?? 0 }}</h2>
                </div>
                <div class="card">
                    <h3>Late</h3>
                    <h2 class="late">{{ $lateThisMonth ?? 0 }}</h2>
                </div>
            </div>

            <div class="table-box">
                <div class="table-title">Attendance Records</div>
                @if($attendances->isEmpty())
                    <div class="empty-state">No attendance records found for this month.</div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}</td>
                                    <td>{{ $attendance->time_in ? \Carbon\Carbon::parse($attendance->time_in)->format('g:i A') : '—' }}</td>
                                    <td>{{ $attendance->time_out ? \Carbon\Carbon::parse($attendance->time_out)->format('g:i A') : '—' }}</td>
                                    <td>
                                        <span class="status-chip status-{{ strtolower($attendance->status) }}">
                                            {{ $attendance->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
