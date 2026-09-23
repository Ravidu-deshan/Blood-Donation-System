<?php
    include('connection.php');
    $error = "";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';




    if(isset($_POST['registerBtn']))
    {
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $uname = mysqli_real_escape_string($connection,$_POST['uname']);
        $address = mysqli_real_escape_string($connection,$_POST['address']);
        $tp = mysqli_real_escape_string($connection,$_POST['tp']);
        $hospital = mysqli_real_escape_string($connection,$_POST['hospital']);
        $blood_type = mysqli_real_escape_string($connection,$_POST['blood_type']);
        $weight = mysqli_real_escape_string($connection,$_POST['weight']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $district = mysqli_real_escape_string($connection,$_POST['district']);
        $pass = sha1('123');
        
        $query = "INSERT INTO user(email,pass,name,uname,tp,hospital,role,district) values('$email','$pass','$name','$uname','$tp','$hospital','user','$district')";
        $queryCheck = "SELECT * FROM user WHERE email='$email'";

        $rCheck = mysqli_query($connection,$queryCheck);
        if($rCheck)
        {

                if(mysqli_num_rows($rCheck)==0)
                {
                    // header('Location: ../admin.php?sec=1');
                    $rinsert = mysqli_query($connection,$query);
                    if($rinsert)
                    {
                        $query1 = "UPDATE donor set address='$address',blood='$blood_type',weight='$weight' WHERE email='$email'";
                        $queryCheck1 = mysqli_query($connection,$query1);
                        if($queryCheck1)
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
                                $mail->Subject = 'User Registration';
                                $mail->Body = "Dear $name,<br><br>"
                                . "You have been successfully registered with the following details:<br><br>"
                                . "<b>Username:</b> $uname<br>"
                                . "<b>Address:</b> $address<br>"
                                . "<b>Contact Number:</b> $tp<br>"
                                . "<b>Hospital:</b> $hospital<br>"
                                . "<b>Blood Type:</b> $blood_type<br>"
                                . "<b>Weight:</b> $weight kg<br>"
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
                            header('Location: ../admin.php?sec=1');
                        }else
                        {
                            echo "query 2 not added";
                        } 

                    }else
                    {
                        echo "not run first query";
                    }

                }
                else header('Location: ../admin.php?sec=1&err=ee');
        }
        else
        {
            $error = "rcheck query ";            
        }
        echo $error;

        
    }
?>
