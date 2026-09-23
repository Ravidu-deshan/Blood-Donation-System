<?php
    include('../include/connection.php');
    session_start();
    $email = "";
    $error = "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');
?>

<!-- details auto fill  -->
<?php

    $query = "SELECT u.id AS user_id, u.email AS user_email,u.hospital AS hospital, u.pass AS user_password,u.uname AS uname,u.name AS fname,u.tp AS tp,d.id AS donor_id, d.email AS donor_email,d.address AS adrs FROM user u INNER JOIN donor d ON u.email = d.email WHERE u.email = '$email'";
    $r = mysqli_query($connection,$query);
    $uname = "";
    $fname = "";
    $address = "";
    $tp = "";
    $hospital = "";
    
    if($r)
    {
        
        while($record = mysqli_fetch_assoc($r))
        {
            $uname = $record['uname'];
            $fname = $record['fname'];
            $address = $record['adrs'];
            $tp = $record['tp'];
            $hospital = $record['hospital'];

            $_SESSION['uname'] = $uname;
        }

        // echo "$uname $fname $address $tp";
    }

?>

<!-- change details  -->
 <?php

    if(isset($_POST['fupbtn']))
    {
        $ffname = mysqli_real_escape_string($connection,$_POST['ffname']);
        $femail = mysqli_real_escape_string($connection,$_POST['femail']);
        $funame = mysqli_real_escape_string($connection,$_POST['funame']);
        $fadrs = mysqli_real_escape_string($connection,$_POST['fadrs']);
        $ftp = mysqli_real_escape_string($connection,$_POST['ftp']);
        $fhospital = mysqli_real_escape_string($connection,$_POST['hospital']);

        
                
        $query_user = "UPDATE user SET name = '$ffname', uname = '$funame', tp = '$ftp' ,hospital='$fhospital' WHERE email = '$email'";
        mysqli_query($connection, $query_user);
        
        $query_donor = "UPDATE donor SET address = '$fadrs' WHERE email = '$email'";
        mysqli_query($connection, $query_donor);
        header('Location: index.php');
        exit();
        
    }




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function enableEdit() {
            document.getElementById("editBtn").style.display = "none"; // Hide Edit button
            document.getElementById("updateBtn").style.display = "block"; // Show Update button
            
            let fields = document.getElementsByClassName("user-input");
            for (let i = 0; i < fields.length; i++) {
                fields[i].removeAttribute("readonly");
            }
        }
    </script>
    <style>
        .card {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        body {
            background: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center text-danger">My Account Details</h2>
    
    <div class="card">
        <form method="post" action="myaccountdetails.php">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control user-input" name="ffname" value="<?=$fname ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control user-input" name="funame" value="<?=$uname ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control user-input" name="femail" value="<?=$email ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control user-input" name="fadrs" value="<?=$address ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Telephone</label>
                <input type="tel" class="form-control user-input" name="ftp" value="<?=$tp ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Hospital</label>
                <input type="text" class="form-control user-input" name="hospital" value="<?=$hospital ?>" readonly>
            </div>

            <button type="button" class="btn btn-danger w-100" id="editBtn" onclick="enableEdit()">Edit</button>
            <button type="submit" class="btn btn-success w-100 mt-2" id="updateBtn" name="fupbtn" style="display:none;">Update</button>
        </form>
    </div>
</div>

</body>
</html>
