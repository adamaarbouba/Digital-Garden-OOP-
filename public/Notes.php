<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Notes - Digital Garden</title>
    <link rel="stylesheet" href="../public_assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <div class="container">
            <nav>
                <div class="logo">Digital Garden</div>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container notes">

        <div style="margin-bottom: 20px;">
            <a href="dashboard.php" style="color: #7f8c8d; text-decoration: none;">&larr; Back to Dashboard</a>
        </div>

        <div class="dashboard-header">
            <h2>Notes for "Personal Projects"</h2>
            <a href="create_note.php?theme_id=1" class="add-btn">+ New Note</a>
        </div>

        <div class="note-grid">

            <div class="note-card">
                <span class="importance-badge importance-high">High Priority</span>
                <h3>Database Schema Idea</h3>
                <p class="note-excerpt">
                    I need to restructure the foreign keys on the users table to ensure cascading deletes work properly...
                </p>
                <div class="theme-meta" style="margin-top: 15px; display:flex; justify-content:space-between; align-items:center;">
                    <span>Dec 30, 2025</span>
                    <div>
                        <a href="edit_note.php?id=101" style="color:#3498db; margin-right:10px;"><i class="fa-solid fa-pen"></i></a>
                        <a href="delete_note.php?id=101" style="color:#e74c3c;"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>

            <div class="note-card">
                <span class="importance-badge importance-low">Idea</span>
                <h3>UI Color Palette</h3>
                <p class="note-excerpt">
                    Maybe switch the primary color to a softer teal? Hex code #1abc9c looks good on white backgrounds.
                </p>
                <div class="theme-meta" style="margin-top: 15px; display:flex; justify-content:space-between; align-items:center;">
                    <span>Dec 28, 2025</span>
                    <div>
                        <a href="#" style="color:#3498db; margin-right:10px;"><i class="fa-solid fa-pen"></i></a>
                        <a href="#" style="color:#e74c3c;"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Digital Garden</p>
        </div>
    </footer>

</body>

</html>