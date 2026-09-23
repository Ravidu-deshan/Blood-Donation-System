<?php
    include('../include/connection.php');
    session_start();
    $email = "";
    $error = isset($_GET['err']) ? $_GET['err'] : "";
    $suc = isset($_GET['suc']) ? $_GET['suc'] : "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');
?>

<!-- details auto fill  -->
<?php

    $query = "SELECT * from user where email = '$email'";
    $r = mysqli_query($connection,$query);
    $pass = "";
        
    if($r)
    {
        
        while($record = mysqli_fetch_assoc($r))
        {
            $pass = $record['pass'];
            
        }        
    }

    if(isset($_POST['fupbtn']))
    {
        $opass = sha1(mysqli_real_escape_string($connection,$_POST['opass']));
        $npass = sha1(mysqli_real_escape_string($connection,$_POST['npass']));

        if($pass===$opass)
        {
            $upquery = "UPDATE user set pass='$npass' WHERE email='$email'";
            mysqli_query($connection,$upquery);
            header('Location: index.php?sec=6&suc=Password changed successfully');
            exit();
        }
        else
        {
            header('Location: index.php?sec=6&err=Invalid Password');
            exit(); 
        }
        
        
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
        .error {
            color: red;
            text-align: center;
        }
        .suc {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center text-danger">Change Password</h2>
    
    <div class="card">
        <form method="post" action="password.php">
            <?php if ($error) echo "<p class='error'>$error</p>"; ?>
            <?php if ($suc) echo "<p class='suc'>$suc</p>"; ?>
            <div class="mb-3">
                <label class="form-label">Old Password</label>
                <input type="text" class="form-control user-input" name="opass">
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="text" class="form-control user-input" name="npass" id="npass" >
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control user-input" name="cpass" id="cpass">
                <small id="passwordError" class="text-danger"></small>
            </div>
                        
            <button type="submit" class="btn btn-danger w-100 mt-2" id="updateBtn" name="fupbtn">Update</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let password = document.getElementById("npass");
        let confirmPassword = document.getElementById("cpass");
        let passwordError = document.getElementById("passwordError");
        let registerBtn = document.getElementById("updateBtn");

        function validatePassword() {
            if (confirmPassword.value === "") {
                passwordError.textContent = "";
                registerBtn.disabled = true;
            } else if (password.value !== confirmPassword.value) {
                passwordError.textContent = "Passwords do not match!";
                registerBtn.disabled = true;
            } else {
                passwordError.textContent = "";
                registerBtn.disabled = false;
            }
        }

        password.addEventListener("input", validatePassword);
        confirmPassword.addEventListener("input", validatePassword);
    });
</script>

</body>
</html>
