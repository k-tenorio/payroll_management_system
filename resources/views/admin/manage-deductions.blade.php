<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Deductions</title>

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

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #1e293b;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        /* ALERT */

        .status-banner {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* TABLE */

        .table-box {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
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

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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

        .cancel-btn {
            background: #94a3b8;
        }

        .cancel-btn:hover {
            background: #64748b;
        }

        .save-btn {
            background: #2563eb;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        /* MODAL */

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 100;
        }

        .modal-backdrop.open {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e2e8f0;
        }

        .modal h2 {
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 22px;
        }

        .modal label {
            display: block;
            margin-bottom: 6px;
            margin-top: 15px;
            font-size: 14px;
            color: #475569;
        }

        .modal input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .modal input:focus {
            border-color: #2563eb;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
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
                <a href="{{ route('admin.manage-payroll.index') }}">Payroll</a>
                <a href="{{ route('admin.manage-deductions.index') }}" class="active">Manage Deductions</a>
                <a href="{{ route('admin.manage-position-department.index') }}">Position & Department</a>
                <a href="{{ route('admin.manage-payslips.index') }}">Payslips</a>
            </nav>

        </aside>

        <main class="main-content">

            <div class="topbar">
                <h1>Manage Deductions</h1>

                <button type="button"
                    class="add-btn"
                    onclick="openModal('addModal')">

                    Add Deduction

                </button>
            </div>

            @if(session('success'))
            <div class="status-banner">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-box">

                <table>

                    <thead>
                        <tr>
                            <th>Deduction ID</th>
                            <th>Deduction Name</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($deductions as $deduction)

                        <tr>

                            <td>{{ $deduction->deduction_id }}</td>

                            <td>{{ $deduction->deduction_name }}</td>

                            <td>
                                ₱{{ number_format($deduction->amount, 2) }}
                            </td>

                            <td>

                                <div class="actions">

                                    <button type="button"
                                        class="btn edit-btn"
                                        data-id="{{ $deduction->deduction_id }}"
                                        data-deduction-name="{{ $deduction->deduction_name }}"
                                        data-amount="{{ $deduction->amount }}"
                                        onclick="openEdit(this)">

                                        Edit

                                    </button>

                                    <form method="POST"
                                        action="{{ route('admin.manage-deductions.destroy', $deduction->deduction_id) }}">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn delete-btn">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="empty-row">
                                No deductions found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </main>

    </div>

    <!-- ADD MODAL -->

    <div id="addModal" class="modal-backdrop">

        <div class="modal">

            <h2>Add Deduction</h2>

            <form method="POST"
                action="{{ route('admin.manage-deductions.store') }}">

                @csrf

                <label>Deduction Name</label>

                <input type="text"
                    name="deduction_name"
                    placeholder="Enter deduction name"
                    required>

                <label>Amount</label>

                <input type="number"
                    name="amount"
                    step="0.01"
                    placeholder="Enter amount"
                    required>

                <div class="modal-actions">

                    <button type="button"
                        class="btn cancel-btn"
                        onclick="closeModal('addModal')">

                        Cancel

                    </button>

                    <button type="submit"
                        class="btn save-btn">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- EDIT MODAL -->

    <div id="editModal" class="modal-backdrop">

        <div class="modal">

            <h2>Edit Deduction</h2>

            <form id="editForm"
                method="POST"
                action="">

                @csrf
                @method('PUT')

                <label>Deduction Name</label>

                <input type="text"
                    id="edit-deduction-name"
                    name="deduction_name"
                    required>

                <label>Amount</label>

                <input type="number"
                    id="edit-amount"
                    name="amount"
                    step="0.01"
                    required>

                <div class="modal-actions">

                    <button type="button"
                        class="btn cancel-btn"
                        onclick="closeModal('editModal')">

                        Cancel

                    </button>

                    <button type="submit"
                        class="btn save-btn">

                        Save Changes

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('open');
        }

        function openEdit(button) {

            let modal = document.getElementById('editModal');
            let form = document.getElementById('editForm');

            let deductionId = button.dataset.id;
            let deductionName = button.dataset.deductionName;
            let deductionAmount = button.dataset.amount;

            form.action = '/admin/manage-deductions/' + deductionId;

            document.getElementById('edit-deduction-name').value = deductionName;
            document.getElementById('edit-amount').value = deductionAmount;

            modal.classList.add('open');
        }

        window.addEventListener('click', function(event) {

            ['addModal', 'editModal'].forEach(function(id) {

                let modal = document.getElementById(id);

                if (event.target === modal) {
                    closeModal(id);
                }

            });

        });
    </script>

</body>

</html>