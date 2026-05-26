<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Position & Department</title>

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

        /* MAIN */

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

        /* ALERTS */

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error ul {
            margin-left: 18px;
        }

        /* SECTION */

        .section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .section h2 {
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 22px;
        }

        /* FORM */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
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

        /* BUTTONS */

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
        }

        .add-btn {
            background: #2563eb;
            color: white;
        }

        .add-btn:hover {
            background: #1d4ed8;
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
            color: white;
        }

        .delete-btn:hover {
            background: #b91c1c;
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

        .actions {
            display: flex;
            gap: 8px;
        }

        .empty-row {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }

        .logout {
            margin-top: auto;
        }

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

        .logout button:hover {
            background: #b91c1c;
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
                <a href="{{ route('admin.manage-payroll.index') }}">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}" class="active">
                    Position & Department
                </a>
                <a href="{{ route('admin.manage-payslips.index') }}">Payslips</a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="logout">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </aside>

        <main class="main-content">

            <div class="header">
                <h1>Manage Position & Department</h1>
                <p>Manage company departments and employee positions</p>
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

            <!-- DEPARTMENT SECTION -->

            <section class="section">

                <h2>Manage Departments</h2>

                <form action="{{ route('admin.department.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <input type="text"
                            name="department_name"
                            placeholder="Department Name"
                            required>

                        <button type="submit" class="btn add-btn">
                            Add Department
                        </button>

                    </div>

                </form>

                <div class="table-box">

                    <table>

                        <thead>
                            <tr>
                                <th>Department ID</th>
                                <th>Department Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($departments as $department)

                            <tr>

                                <td>{{ $department->department_id }}</td>

                                <td>{{ $department->department_name }}</td>

                                <td>

                                    <div class="actions">

                                        <form action="{{ route('admin.department.delete', $department->department_id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn delete-btn"
                                                onclick="return confirm('Delete this department?')">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="3" class="empty-row">
                                    No departments found.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            <!-- POSITION SECTION -->

            <section class="section">

                <h2>Manage Positions</h2>

                <form action="{{ route('admin.position.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <input type="text"
                            name="position_name"
                            placeholder="Position Name"
                            required>

                        <select name="department_id" required>

                            <option value="">Select Department</option>

                            @foreach($departments as $department)

                            <option value="{{ $department->department_id }}">
                                {{ $department->department_name }}
                            </option>

                            @endforeach

                        </select>

                        <input type="number"
                            name="basic_salary"
                            placeholder="Basic Salary"
                            required>

                        <button type="submit" class="btn add-btn">
                            Add Position
                        </button>

                    </div>

                </form>

                <div class="table-box">

                    <table>

                        <thead>
                            <tr>
                                <th>Position ID</th>
                                <th>Position Name</th>
                                <th>Department</th>
                                <th>Basic Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($positions as $position)

                            <tr>

                                <td>{{ $position->position_id }}</td>

                                <td>{{ $position->position_name }}</td>

                                <td>
                                    {{ optional($position->department)->department_name ?? '—' }}
                                </td>

                                <td>
                                    ₱{{ number_format($position->basic_salary, 2) }}
                                </td>

                                <td>

                                    <div class="actions">

                                        <form action="{{ route('admin.position.delete', $position->position_id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn delete-btn"
                                                onclick="return confirm('Delete this position?')">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="empty-row">
                                    No positions found.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

        </main>

    </div>

</body>

</html>