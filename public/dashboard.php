<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Digital Garden</title>
    <link rel="stylesheet" href="../public_assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <?php 
    include_once "../includes/header.php";
    ?>

    <main class="container notes">

        <div class="dashboard-header">
            <h2>My Themes</h2>
            <a href="" class="add-btn">+ New Theme</a>
        </div>

        <div class="note-grid">

            <div class="theme-card">
                <div class="theme-color-strip" style="background-color: #3498db;"></div>
                <div class="theme-card-body">
                    <h3>Personal Projects</h3>
                    <div class="theme-meta">Created: Dec 12, 2025</div>
                    <p>Notes related to my side coding projects and ideas.</p>
                </div>
                <div class="theme-actions">
                    <a href="Notes.php?theme_id=1" class="btn-outline">View Notes</a>
                </div>
            </div>

            <div class="theme-card">
                <div class="theme-color-strip" style="background-color: #e74c3c;"></div>
                <div class="theme-card-body">
                    <h3>Work Meetings</h3>
                    <div class="theme-meta">Created: Dec 20, 2025</div>
                    <p>Meeting minutes and action items.</p>
                </div>
                <div class="theme-actions">
                    <a href="Notes.php?theme_id=2" class="btn-outline">View Notes</a>
                </div>
            </div>

        </div>
    </main>

    <?php
    include_once "../includes/footer.php";
    ?>

</body>

</html>