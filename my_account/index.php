<?php

$section = isset($_GET['sec']) ? $_GET['sec'] : 1;
$uname = isset($_SESSION['uname']) ? $_SESSION['uname'] : "User";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: #dc3545;
            color: white;
            padding: 15px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar .active {
            background: #b52b38;
        }
        .content {
            padding: 20px;
            background: white;
            border-radius: 10px;
        }
        @media (max-width: 768px) {
            .sidebar {
                height: auto;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar">
            <h4><a href="../">Home 🏠</a></h4>
            <a href="index.php?sec=1" class="<?= ($section == 1) ? 'active' : '' ?>">My Account Details</a>
            <a href="index.php?sec=2" class="<?= ($section == 2) ? 'active' : '' ?>">Health</a>
            <a href="index.php?sec=3" class="<?= ($section == 3) ? 'active' : '' ?>">Upcoming Camps</a>
            <a href="index.php?sec=4" class="<?= ($section == 4) ? 'active' : '' ?>">Appointment</a>
            <a href="index.php?sec=5" class="<?= ($section == 5) ? 'active' : '' ?>">Notiicatios</a>
            <a href="index.php?sec=6" class="<?= ($section == 6) ? 'active' : '' ?>">Change Password</a>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 p-4">
            <div class="content">
                
                <div>
                    <?php
                    switch ($section) {
                        case 1:
                            include 'myaccountdetails.php';
                            break;
                        case 2:
                            include 'health.php';
                            break;
                        case 3:
                            include 'camp.php';
                            break;
                        case 4:
                            include 'appointment.php';
                            break;
                        case 5:
                            include 'notification.php';
                            break;
                        case 6:
                            include 'password.php';
                            break;
                        default:
                            echo "<p>Select a section from the sidebar.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
