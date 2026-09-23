<?php
    include('include/connection.php');
    $error = "";

    if(isset($_POST['registerBtn']))
    {
        $uname = mysqli_real_escape_string($connection,$_POST['username']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $district = mysqli_real_escape_string($connection,$_POST['district']);
        $pass = sha1(mysqli_real_escape_string($connection,$_POST['password']));
        
        $query = "INSERT INTO user(email,pass,uname,district) values('$email','$pass','$uname','$district')";
        $queryCheck = "SELECT * FROM user WHERE email='$email'";

        $rCheck = mysqli_query($connection,$queryCheck);
        if($rCheck)
        {

                if(mysqli_num_rows($rCheck)==0)
                {
                    $rinsert = mysqli_query($connection,$query);
                    if($rinsert)
                    {
                        $s = "<script>window.alert(\"Registered Successfully!\");window.location.href=\"login.php\";</script>";
                        echo $s;                        
                    }
                    else $error = "rinsert query not execute";
                }
                else $error = "Email is already exist !";
        }
        else
        {
            $error = "rcheck query ";            
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Blood Donation Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background: #fff; }
        .register-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .register-header {
            text-align: center;
            color: red;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-register {
            background: red;
            color: white;
            width: 100%;
        }
        .btn-register:hover { background: darkred; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-header">Register</div>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form action="register.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <label for="district">Select District</label>
        <select id="district" name="district" class="form-control" required>
            <option value="" disabled selected>-- Select District --</option>
            <option value="Ampara">Ampara</option>
            <option value="Anuradhapura">Anuradhapura</option>
            <option value="Badulla">Badulla</option>
            <option value="Batticaloa">Batticaloa</option>
            <option value="Colombo">Colombo</option>
            <option value="Galle">Galle</option>
            <option value="Gampaha">Gampaha</option>
            <option value="Hambantota">Hambantota</option>
            <option value="Jaffna">Jaffna</option>
            <option value="Kalutara">Kalutara</option>
            <option value="Kandy">Kandy</option>
            <option value="Kegalle">Kegalle</option>
            <option value="Kilinochchi">Kilinochchi</option>
            <option value="Kurunegala">Kurunegala</option>
            <option value="Mannar">Mannar</option>
            <option value="Matale">Matale</option>
            <option value="Matara">Matara</option>
            <option value="Monaragala">Monaragala</option>
            <option value="Mullaitivu">Mullaitivu</option>
            <option value="Nuwara Eliya">Nuwara Eliya</option>
            <option value="Polonnaruwa">Polonnaruwa</option>
            <option value="Puttalam">Puttalam</option>
            <option value="Ratnapura">Ratnapura</option>
            <option value="Trincomalee">Trincomalee</option>
            <option value="Vavuniya">Vavuniya</option>
        </select>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            <small id="passwordError" class="text-danger"></small>
        </div>

        
        <button type="submit" name="registerBtn" id="registerBtn" class="btn btn-register" disabled>Register</button>
    </form>
</div>

<scripy>
    document.addEventListener("DOMContentLoaded", function() {
        let password = document.getElementById("password");
        let confirmPassword = document.getElementById("confirm_password");
        let passwordError = document.getElementById("passwordError");
        let registerBtn = document.getElementById("registerBtn");

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
