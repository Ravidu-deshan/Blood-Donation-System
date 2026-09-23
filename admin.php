<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Blood Donation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: white;
            padding: 20px;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            z-index: 10;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s;
        }
        .hide-sidebar {
            width: 0;
            padding: 0;
        }
        .expand-content {
            margin-left: 0;
        }
        .toggle-btn {
            position: fixed;
            top: 10px;
            left: 260px;
            background: #343a40;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            transition: left 0.3s;
            z-index: 20;
        }
        .toggle-btn.moved {
            left: 10px;
        }
        .toggle-btn:hover {
            background: #495057;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <button class="toggle-btn" id="sidebarToggle">☰</button>
        <nav class="sidebar" id="sidebar">
            <h4>Admin Panel</h4>
            <a href="index.php">Home 🏠</a>
            <a href="admin.php?sec=1">New Donor</a>
            <a href="admin.php?sec=2">Appointments</a>
            <a href="admin.php?sec=3">Staff Reg</a>
            <a href="admin.php?sec=4">Reports</a>
            <a href="admin.php?sec=5">Poster</a>
            <a href="admin.php?sec=6">Add Donation</a>
            <a href="admin.php?sec=7">Request History</a>
            <a href="admin.php?sec=8">Blood Management</a>
            <a href="admin.php?sec=9">Add Hospital</a>
            <a href="request.php">Request</a>
            <a href="logout.php">Logout</a>
        </nav>
        <main class="main-content" id="mainContent">
            <br>
            <!-- <h2>Admin Panel</h2> -->
            <hr>
            <div>
                <?php
                $section = isset($_GET['sec']) ? $_GET['sec'] : 1;
                $file = "sections/section{$section}.php";
                if (file_exists($file)) {
                    include($file);
                } else {
                    echo "<p>Invalid section selected.</p>";
                }
                ?>
            </div>
        </main>
    </div>

    <script>
        document.getElementById("sidebarToggle").addEventListener("click", function() {
            let sidebar = document.getElementById("sidebar");
            let content = document.getElementById("mainContent");
            let toggleBtn = document.getElementById("sidebarToggle");
            
            if (sidebar.classList.contains("hide-sidebar")) {
                sidebar.classList.remove("hide-sidebar");
                content.classList.remove("expand-content");
                toggleBtn.classList.remove("moved");
            } else {
                sidebar.classList.add("hide-sidebar");
                content.classList.add("expand-content");
                toggleBtn.classList.add("moved");
            }
        });
    </script>
</body>
</html>
