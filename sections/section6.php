<!-- Donation Page  -->


<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    
    
    
?>

<?php
    
    include(__DIR__ . '/../include/connection.php');

    if(isset($_POST['submit']))
    {
        $email =  $_POST['email'];
        $type = $_POST['type'];
        $vol = $_POST['volume'];
        $date = date("Y-m-d"); 
        $hospital = "";
        $blood = "";

        $q1 = "SELECT * FROM user WHERE email='$semail'";
        $q2 = "SELECT * FROM donor WHERE email='$email'";
        $r1 = mysqli_query($connection,$q1);
        $r2 = mysqli_query($connection,$q2);
        if($r1 && $r2)
        {
            $rec1 = mysqli_fetch_assoc($r1);
            $rec2 = mysqli_fetch_assoc($r2);

            if ($rec1 && $rec2) {
                
                $hospital = $rec1['hospital'];
                $blood    = $rec2['blood'];
            }

        }
        
        $query = "INSERT INTO donation(dname,sname,type,date,volume,hospital,blood) VALUES('$email','$semail','$type','$date','$vol','$hospital','$blood')";
        $r = mysqli_query($connection,$query);
        if($r)
        {
            header('Location: ../admin.php?sec=6');
            exit();
        }
    }    
    
    if (isset($_POST['check'])) {
        
    
        $email = $_POST['email'];
    
        
        $query = "SELECT * FROM donor WHERE email='$email'";
        $r = mysqli_query($connection, $query);
    
        if ($r && mysqli_num_rows($r) == 1) {
            
            $query = "SELECT d.email, MAX(dn.date) AS latest_donation_date FROM donor d LEFT JOIN donation dn ON d.email = dn.dname WHERE d.email='$email'";
    
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            $latestDonationDate = $row['latest_donation_date'];
    
            
            if ($latestDonationDate === NULL) {
                echo "<script>alert('User is eligible for blood donation.')window.location.href='../admin.php?sec=6';</script>";
            } else {
                
                $latestDate = new DateTime($latestDonationDate);
                $currentDate = new DateTime();
                
                
                $interval = $latestDate->diff($currentDate);
                $monthsSinceLastDonation = $interval->m + ($interval->y * 12);
    
                if ($monthsSinceLastDonation >= 4) {
                    echo "<script>alert('User is eligible for blood donation.');window.location.href='../admin.php?sec=6';</script>";
                } else {
                    echo "<script>alert('User is NOT eligible for blood donation.Last donated on $latestDonationDate.');window.location.href='../admin.php?sec=6';</script>";
                }
            }
        } else {
            echo "<script>alert('User does not exist!'); window.location.href='../admin.php?sec=6';</script>";
        }
    }
?>
    



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 700px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
            color: #dc3545;
        }
        .btn-submit {
            background: #dc3545;
            color: white;
            width: 100%;
        }
        .btn-submit:hover {
            background: #bb2d3b;
        }
        .status-box {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .pending { background: #ffc107; color: black; }
        .queued { background: #17a2b8; color: white; }
        .completed { background: #28a745; color: white; }
        .canceled { background: #dc3545; color: white; }
    </style>
</head>
<body>

<!-- check Eligibility  -->
<div class="container mt-5">
    <h2 class="text-center text-danger">Eligibility Check</h2>
    
    <form action="sections/section6.php" method="POST">
        <div class="mb-3">
            <label class="form-label">User Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        
        <button type="submit" class="btn btn-submit" name="check">Add Donation</button>
    </form>
</div>

<!-- add donation  -->
<div class="container mt-5">
    <h2 class="text-center text-danger">Add Donation</h2>
    
    <form action="sections/section6.php" method="POST">
        <div class="mb-3">
            <label class="form-label">User Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Donation Type</label>
            <select class="form-control" name="type" required>
                <option value="">Select Type</option>
                <option value="Blood">Blood</option>
                <option value="Plasma">Plasma</option>
                <option value="Platelets">Platelets</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Volume (ml)</label>
            <input type="number" class="form-control" name="volume" min="50" required>
        </div>
        <button type="submit" class="btn btn-submit" name="submit">Add Donation</button>
    </form>
</div>

<!-- Donation History -->
<!-- <div class="container mt-5">
    <h3 class="text-center text-danger">Donation History</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Email</th>
                    <th>Type</th>
                    <th>Volume (ml)</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>user@example.com</td>
                    <td>Blood</td>
                    <td>500</td>
                    <td>2025-03-30</td>
                    <td><span class="status-box completed">Completed</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>user2@example.com</td>
                    <td>Plasma</td>
                    <td>300</td>
                    <td>2025-03-29</td>
                    <td><span class="status-box pending">Pending</span></td>
                </tr>
            </tbody>
        </table>
    </div> -->
</div>

</body>
</html>

