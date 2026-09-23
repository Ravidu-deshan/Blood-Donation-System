<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require __DIR__ . '/../vendor/autoload.php';
    
    
    
?>
<?php
    // include('/../include/connection.php');
    include(__DIR__ . '/../include/connection.php');

    $error = "";
    $code = "";

    $query = "SELECT * FROM hospital";
    $r = mysqli_query($connection,$query);

    if($r)
    {
        while($rec= mysqli_fetch_assoc($r))
        {
            $code .="<option>".$rec['name']."</option>";
        }
    }
?>

<?php
    
    if(isset($_POST['registerBtn']))
    {
        $uname = mysqli_real_escape_string($connection,$_POST['username']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $pass = sha1("123");
        $fname = mysqli_real_escape_string($connection,$_POST['name']);
        $tp = mysqli_real_escape_string($connection,$_POST['tp']);
        $role = mysqli_real_escape_string($connection,$_POST['role']);
        $hospital = mysqli_real_escape_string($connection,$_POST['hospital']);
        
        $query = "INSERT INTO user(email,pass,name,uname,tp,hospital,role) values('$email','$pass','$fname','$uname','$tp','$hospital','$role')";
        $queryCheck = "SELECT * FROM user WHERE email='$email'";

        $rCheck = mysqli_query($connection,$queryCheck);
        if($rCheck)
        {

                if(mysqli_num_rows($rCheck)==0)
                {
                    $rinsert = mysqli_query($connection,$query);
                    if($rinsert)
                    {
// *****************************************************************************************************************************************************************************
                                                        // Email sending
                            $mail = new PHPMailer(true);

                            try {
                                // Server settings
                                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output for development
                                $mail->isSMTP();
                                $mail->Host       = 'smtp.gmail.com';
                                $mail->SMTPAuth   = true;
                                $mail->Username   = 'ekabashen1@gmail.com';
                                $mail->Password   = 'rnek ifpe ofnd vzpo';  // ⚠️ Use environment variable in production
                                $mail->SMTPSecure = 'ssl';
                                $mail->Port       = 465;
                            
                                // Recipients
                                $mail->setFrom('ekabashen1@gmail.com', 'Blood Donation Center');
                                $mail->addAddress($email, $uname);  // use actual name instead of 'Joe User'
                            
                                // Content
                                $mail->isHTML(true);
                                $mail->Subject = 'Staff Registration';
                                $mail->Body = "Dear $uname,<br><br>"
                                . "You have been successfully registered with the following details:<br><br>"
                                . "<b>Username:</b> $fname<br>"
                                . "<b>Role:</b> $role at $hospital<br>"
                                . "<b>Contact Number:</b> $tp<br>"
                                . "<b>Hospital:</b> $hospital<br>"
                                . "<b>Email:</b> $email<br><br>"
                                . "Your default password is: <b>123</b><br>"
                                . "Please log in and change your password immediately for security reasons.<br><br>"
                                . "Thank you.";
                    
                    $mail->AltBody = "Dear $name,\n\n"
                                   . "You have been successfully registered with the following details:\n\n"
                                   . "Username: $uname\n"
                                   . "Address: $address\n"
                                   . "Contact Number: $tp\n"
                                   . "Hospital: $hospital\n"
                                   . "Blood Type: $blood_type\n"
                                   . "Weight: $weight kg\n"
                                   . "Email: $email\n\n"
                                   . "Your default password is: 123\n"
                                   . "Please log in and change your password immediately for security reasons.\n\n"
                                   . "Thank you.";
                    
                            
                                // Attempt to send
                                if ($mail->send()) {
                                    echo "✅ Message has been sent to $email<br>";
                                } else {
                                    echo "❌ Message could not be sent to $email. Error: {$mail->ErrorInfo}<br>";
                                }
                            
                            } catch (Exception $e) {
                                echo "❌ Message could not be sent to $email. Mailer Error: {$mail->ErrorInfo}<br>";
                            }


// *****************************************************************************************************************************************************************************
                        echo "registerd success";
                        $s = "<script>window.location.href=\"../admin.php?sec=3\";</script>";
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

        echo $error;

         
        
    }
     
     
?>

<h2>Section 1: Staff Registration</h2>
<form action="sections/section3.php" method="POST">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" class="form-control" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required>

    <label for="username">Username:</label>
    <input type="text" id="email" name="username" class="form-control" required>

    <label for="tp">Telephone:</label>
    <input type="text" id="email" name="tp" class="form-control" required>
    

    <label for="role">Job Role:</label>
    <select id="role" name="role" class="form-control">
        <option>Doctor</option>
        <option>Nurse</option>
        <option>Medical Staff</option>
             
    </select>

    <label for="hospital">Hospital:</label>
    <select id="hospital" name="hospital" class="form-control">
        <?=$code?>
             
    </select>

    <button type="submit" class="btn btn-danger mt-3" name="registerBtn">Submit</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<p class='alert alert-success mt-3'>Staff Member registered successfully!</p>";
}
?>
