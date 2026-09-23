<?php
    include('../include/connection.php');
    session_start();
    $email = "";
    $error = "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');


      

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Campaigns</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1000px;
        }
        .campaign-title {
            text-align: center;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .campaign-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            position: relative;
            height: 100%; /* Ensure the card stays fixed in size */
        }
        .campaign-img {
            width: 100%;
            height: 250px; /* Set a fixed height */
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .campaign-card:hover .campaign-img {
            transform: scale(1.5); /* Increases size by 50% */
            object-position: center; /* Center the image when scaling */
        }
        .campaign-info {
            padding: 15px;
            background: white;
            text-align: center;
        }
        .campaign-location {
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="campaign-title">Upcoming Blood Donation Campaigns</h2>

    <div class="row g-4">
        
<?php
    $path = "";
    $location = "";
    $date = "";
    
    $q = "SELECT * FROM poster WHERE date >= CURDATE()";
    $r = mysqli_query($connection,$q);
    if($r)
    {
        while($rec = mysqli_fetch_assoc($r))
        {
            $path = $rec['path'];
            $location = $rec['location'];
            $date = $rec['date'];


?>
        <!-- Campaign  -->
        <div class="col-md-6 col-lg-4">
            <a href="<?=$location?>" target="_blank" class="text-decoration-none">
                <div class="campaign-card">
                    <img src="../sections/<?=$path?>" alt="Campaign 2" class="campaign-img">
                    <div class="campaign-info">
                        <h5 class="text-danger">Hope Blood Camp</h5>
                        <p class="campaign-location">Kandy, Sri Lanka</p>
                    </div>
                </div>
            </a>
        </div>
        <?php
  }
}


?>


    </div>
</div>

</body>
</html>
