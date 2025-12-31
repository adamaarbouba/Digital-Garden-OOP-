<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Digital Garden</title>
    <link rel="stylesheet" href="../public_assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container">
            <nav>
                <div class="logo">DG Admin</div>
                <ul>
                    <li><a href="../service/Logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container notes">

        <div class="dashboard-header">
            <h2>User Management</h2>
            <div>
                <span style="color: #7f8c8d; font-size: 0.9em;">Total Users: 4</span>
            </div>
        </div>

        <div class="table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#10</td>
                        <td><strong>john_doe</strong></td>
                        <td>john@example.com</td>
                        <td>User</td>
                        <td><span class="status-badge status-active">Unblocked</span></td>
                        <td>
                            <form action="update_status.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="10">
                                <input type="hidden" name="new_status" value="BLOCKED">
                                <button type="submit" class="btn-sm btn-danger">Block</button>
                            </form>
                        </td>
                    </tr>

                    <tr>
                        <td>#12</td>
                        <td><strong>spammer_123</strong></td>
                        <td>spam@example.com</td>
                        <td>User</td>
                        <td><span class="status-badge status-blocked">Blocked</span></td>
                        <td>
                            <form action="update_status.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="12">
                                <input type="hidden" name="new_status" value="UNBLOCKED">
                                <button type="submit" class="btn-sm btn-success">Unblock</button>
                            </form>
                        </td>
                    </tr>

                    <tr>
                        <td>#1</td>
                        <td><strong>SuperAdmin</strong></td>
                        <td>admin@youcode.ma</td>
                        <td>Admin</td>
                        <td><span class="status-badge status-admin">Active</span></td>
                        <td>
                            <form action="update_status.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="1">
                                <input type="hidden" name="new_status" value="BLOCKED">
                                <button type="submit" class="btn-sm btn-danger">Block</button>
                            </form>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Digital Garden Admin Panel</p>
        </div>
    </footer>

</body>

</html>