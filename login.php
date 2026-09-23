<?php
session_start();
$error = "";
include('include/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = sha1(mysqli_real_escape_string($connection,$_POST['password']));
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $secretKey = "6LdpFfQqAAAAAEyxbo9TgYIw4feu4ggWNnNEWzaN"; // Your secret key
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse";
    $response = file_get_contents($verifyURL);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        $error = "reCAPTCHA verification failed. Please try again.";
    } else {
        
        $query = "SELECT * FROM user WHERE email='$email' and pass='$password'";
        $r = mysqli_query($connection,$query);
        if($r)
        {
            if(mysqli_num_rows($r)==1)
            {
                $rec = mysqli_fetch_assoc($r);

                $_SESSION['email'] = $email;
                $_SESSION['role'] = $rec['role'];
                $_SESSION['hospital'] = $rec['hospital'];                
                
                ($rec['role'] == 'user') ? header("Location: my_account/") : header("Location: admin.php?sec=1");
                exit();
            }
        } else 
        {
            $error = "invalid username or password";
        }
        

        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blood Donation Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            background: #fff;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .login-header {
            text-align: center;
            color: red;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-login {
            background: red;
            color: white;
            width: 100%;
        }
        .btn-login:hover {
            background: darkred;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">Login</div>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="6LdpFfQqAAAAAFNZabIIMTbp9LJ7l_NjQKwTYO4E"></div>
        </div>
        <button type="submit" class="btn btn-login">Login</button>
    </form>
</div>

</body>
</html>
