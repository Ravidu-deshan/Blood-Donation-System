<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$is_logged_in = isset($_SESSION['email']); // Assuming user_id is set when logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 15px 20px; /* Adjusted padding for responsiveness */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e63946;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 10px; /* Adjusted gap for responsiveness */
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 5px 10px; /* Added padding for touch targets */
        }

        .register-btn {
            background: #e63946;
            color: #fff;
            border: none;
            padding: 8px 15px; /* Adjusted padding for responsiveness */
            cursor: pointer;
            border-radius: 5px;
        }

        .account-icon {
            background: #e63946;
            color: #fff;
            padding: 8px; /* Adjusted padding for responsiveness */
            border-radius: 50%;
            cursor: pointer;
            position: relative;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 120px; /* Adjusted min-width for responsiveness */
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0; /* Align dropdown to the right */
        }

        /* Dropdown links */
        .dropdown-content a {
            color: black;
            padding: 10px 12px; /* Adjusted padding for responsiveness */
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown when hovering the icon */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        .user-btns {
            display: flex;
            gap: 10px; /* Adjusted gap for responsiveness */
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }

            nav ul {
                flex-direction: column;
                width: 100%;
                margin-top: 10px;
                align-items: flex-start;
            }

            nav ul li {
                width: 100%;
            }

            nav ul li a {
                display: block;
                width: 100%;
                padding: 8px 10px;
                text-align: left;
            }

            .user-btns {
                margin-top: 10px;
                width: 100%;
                justify-content: flex-end;
            }

             .dropdown-content {
                right:auto;
                left:0;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Life<span>Share</span></div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about us.html">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="user-btns">
            <?php if ($is_logged_in): ?>
                <div class="dropdown">
                    <div class="account-icon">👤</div>
                    <div class="dropdown-content">
                        <?php if ($role != 'user'): ?>
                            <a href="admin.php">Admin</a>
                        <?php endif; ?>
                        <a href="my_account">My Account</a>
                        <a href="logout.php">Logout</a>
                        
                    </div>
                </div>
            <?php else: ?>
                <button class="register-btn" onclick="window.location.href='login.php'">Login</button>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>