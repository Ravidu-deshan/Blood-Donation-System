<?php
    include('../include/connection.php');
    session_start();
    $email = "";
    $error = "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');
?>

<?php

    $q = "SELECT * FROM request where status='pending'";
    $r = mysqli_query($connection,$q);
    $code = "";

    if($r)
    {
        while($rec = mysqli_fetch_assoc($r))
        {
            $code .= "<div class=\"notification\">";
            $code .= "<strong>Blood Required:</strong> ".$rec['blood']." at ".$rec['hospital']."<br>";
            $code .= "<strong>Critical Level:</strong> ".$rec['level']."<br>";
            $code .= "<strong>Blood Type:</strong> ".$rec['blood']."<br>";
            $code .= "<strong>Notification Date:</strong> ".$rec['date']."<br>";
            $code .= "<span class=\"contact\">Contact: ".$rec['tp']."</span>";
            $code .= "</div>";

        }
    }




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #d9534f;
        }
        .notification {
            padding: 15px;
            margin: 10px 0;
            border-left: 5px solid #d9534f;
            background: #fff3f3;
            border-radius: 5px;
        }
        .notification strong {
            color: #d9534f;
        }
        .contact {
            font-size: 14px;
            color: #555;
        }
        @media (max-width: 600px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            .notification {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Notifications</h2>
        <?=$code?>
    </div>
</body>
</html>
