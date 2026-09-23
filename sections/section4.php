<!-- Report  -->

<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    
    
    
?>

<?php
    include(__DIR__ . '/../include/connection.php');

    $blood_count = "";
    $plasma_count = "";
    $platelet_count = "";


    
    $shospital = $_SESSION['hospital'];
    $q1 = "SELECT 
    SUM(CASE WHEN type = 'A-pos' THEN vol ELSE 0 END) AS A_pos,
    SUM(CASE WHEN type = 'A-neg' THEN vol ELSE 0 END) AS A_neg,
    SUM(CASE WHEN type = 'B-pos' THEN vol ELSE 0 END) AS B_pos,
    SUM(CASE WHEN type = 'B-neg' THEN vol ELSE 0 END) AS B_neg,
    SUM(CASE WHEN type = 'O-pos' THEN vol ELSE 0 END) AS O_pos,
    SUM(CASE WHEN type = 'O-neg' THEN vol ELSE 0 END) AS O_neg,
    SUM(CASE WHEN type = 'AB-pos' THEN vol ELSE 0 END) AS AB_pos,
    SUM(CASE WHEN type = 'AB-neg' THEN vol ELSE 0 END) AS AB_neg,
    SUM(CASE WHEN type = 'plasma' THEN vol ELSE 0 END) AS plasma_count,
    SUM(CASE WHEN type = 'platelet' THEN vol ELSE 0 END) AS platelet_count
    FROM record WHERE hospital = '$shospital'";
 
    $r1 = mysqli_query($connection,$q1);
    if($r1)
    {
    $rec1 = mysqli_fetch_assoc($r1);       

    if ($rec1) {
        $A_pos = $rec1['A_pos'];
        $A_neg = $rec1['A_neg'];
        $B_pos = $rec1['B_pos'];
        $B_neg = $rec1['B_neg'];
        $O_pos = $rec1['O_pos'];
        $O_neg = $rec1['O_neg'];
        $AB_pos = $rec1['AB_pos'];
        $AB_neg = $rec1['AB_neg'];
                            
    }

    }
    
    

    //user count 

    $q3 = "SELECT COUNT(*) AS user_count 
    FROM user 
    WHERE role = 'user' AND hospital = '$shospital'";
    $r3 = mysqli_query($connection,$q3);
    if($r3)
    {
        $rec3 = mysqli_fetch_assoc($r3);       

        if ($rec3) {
            $user_count = $rec3['user_count'];
                                   
        }

    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cards {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .card {
            flex: 1;
            padding: 20px;
            background: red;
            color: white;
            text-align: center;
            border-radius: 5px;
        }
        canvas {
            margin-top: 20px;
            width: 100% !important;
            height: auto !important;
        }
        @media (max-width: 768px) {
            .cards {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Report</h2>
        <div class="cards">
            <div class="card">Registered Users: <?=$user_count?></div>
            <div class="card">Total Staff: 50</div>
        </div>
        <canvas id="bloodChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('bloodChart').getContext('2d');
        const bloodChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['A+','A-','B+','B-','O+','O-','AB+', 'AB-', 'Plasma', 'Platelets'],
                datasets: [{
                    label: 'Available Units',
                    data: [<?=$A_pos?>, <?=$A_neg?>, <?=$B_pos?>, <?=$B_neg?>,<?=$O_pos?>,<?=$O_neg?>,<?=$AB_pos?>,<?=$A_neg?>,<?=$plasma_count?>,<?=$platelet_count?>],
                    backgroundColor: ['#FF5733', '#C70039', '#900C3F', '#581845','#FF5733', '#C70039', '#900C3F', '#581845', '#900C3F', '#581845'],
                    borderColor: ['#FF5733', '#C70039', '#900C3F', '#581845','#FF5733', '#C70039', '#900C3F', '#581845', '#900C3F', '#581845'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
