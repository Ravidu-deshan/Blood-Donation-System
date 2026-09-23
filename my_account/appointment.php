<?php
    include('../include/connection.php');
    session_start();
    $email = "";
    $error = "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');
    
?>

<!-- make appontment  -->
<?php
    

    if(isset($_POST['registerBtn']))
    {
        $date = mysqli_real_escape_string($connection,$_POST['date']);
        $type = mysqli_real_escape_string($connection,$_POST['type']);
        
        
        $query = "INSERT INTO appointment(user,type,date,status) values('$email','$type','$date','pending')";
        

        $rCheck = mysqli_query($connection,$query);
        if($rCheck)
        {
            header('Location: index.php?sec=4&msg=suc');
        }
        else
        {
            $error = "rcheck query ";            
        }

        
    }
?>

<!-- Display details  -->
<?php

    $query = "SELECT * FROM appointment ORDER BY date";
    $code = "";
    $r = mysqli_query($connection,$query);
    if($r)
    {
        while($rec = mysqli_fetch_assoc($r))
        {
            $code .= "<tr>
                    <td>".$rec['id']."</td>
                    <td>".$rec['date']."</td>
                    <td>".$rec['staff']."</td>
                    <td>".$rec['type']."</td>";

            $status = $rec['status'];
            switch($status){
                case "pending":
                    $code .= '<td><span class="status-box pending">Waiting</span></td></tr>';
                    break;
                case "queued":
                    $code .= '<td><span class="status-box queued">In Progress</span></td></tr>';
                    break;
                case "completed":
                    $code .= '<td><span class="status-box completed">Completed</span></td></tr>';
                    break;
                default:
                    $code .= '<td><span class="status-box canceled">Canceled</span></td></tr>';
                    break;
            }
            
        }
    }
    

?>

<!-- get last donated date  -->
<?php
      
     $monthsSinceLastDonation = "";
         
         $query = "SELECT d.email, MAX(dn.date) AS latest_donation_date FROM donor d LEFT JOIN donation dn ON d.email = dn.dname WHERE d.email='$email'";
 
         $result = mysqli_query($connection, $query);
         $row = mysqli_fetch_assoc($result);
         $latestDonationDate = $row['latest_donation_date'];
 
         
         if ($latestDonationDate === NULL) {
            $monthsSinceLastDonation = 5;
             
         } else {
             
             $latestDate = new DateTime($latestDonationDate);
             $currentDate = new DateTime();
             
             
             $interval = $latestDate->diff($currentDate);
             $monthsSinceLastDonation = $interval->m + ($interval->y * 12); //how many months after the donation 

             
         }         
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .status-box {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }
        .pending { background: yellow; color: white; }
        .queued { background: orange; color: white; }
        .completed { background: green; color: white; }
        .canceled { background: red; color: white; }
        @media (max-width: 768px) {
            .table-responsive { overflow-x: auto; }
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center text-danger">Make an Appointment</h2>

    <!-- Appointment Booking Form -->
    <div class="card">
        <form action="appointment.php" method="post">
            <div class="mb-3">
                <label class="form-label">Select Date</label>
                <input type="date" class="form-control" name="date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Appointment Type</label>
                <select class="form-select" name="type" required>
                    <option value="">Select Type</option>

                    <?=($monthsSinceLastDonation > 4) ? '<option value="Blood Donation">Blood Donation</option>' : ''?>
                    
                    <option value="Health Checkup">Health Checkup</option>
                    <option value="Counseling">Counseling</option>
                </select>
            </div>

            <button type="submit" class="btn btn-danger w-100" name="registerBtn">Book Appointment</button>
        </form>
    </div>

    <h3 class="mt-4 text-center text-danger">My Appointments</h3>

    <!-- Appointment Details Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>AID</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?=$code?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
