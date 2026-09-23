<?php
    include('include/connection.php');
    session_start();
    $email = "";
    $error = "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
?>

<?php

    if(isset($_POST['submit']))
    {
        $blood = $_POST['bloodtype'];
        $hospital = $_SESSION['hospital'];
        $level = $_POST['urgency'];
        $tp = $_POST['contact'];
        $district = $_POST['district'];

        $q = "INSERT INTO request (blood, hospital, level, tp, date, status) 
              VALUES ('$blood', '$hospital', '$level', '$tp', CURRENT_DATE, 'pending')";

        $r = mysqli_query($connection,$q);
        if($r==1)
        {
// ***********************************************************************************************************
            $q1 = "SELECT d.email , u.uname
                    FROM donor d 
                    INNER JOIN user u ON d.email = u.email 
                    WHERE d.blood = '$blood' 
                    AND u.district = '$district'";
            $r1 = mysqli_query($connection,$q1);        
            if($r1)
            {
                while($rec1=mysqli_fetch_assoc($r1))
                {
                    $e = $rec1['email'];
                    $u = $rec1['uname'];

                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'ekabashen1@gmail.com';                     //SMTP username
                        $mail->Password   = 'rnek ifpe ofnd vzpo';                               //SMTP password
                        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('ekabashen1@gmail.com', 'Mailer');
                        $mail->addAddress($e, 'Joe User');     //Add a recipient
                        

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Urgent Blood Donation Request';
                        $mail->Body = "Dear $u,\n\nWe urgently require blood donation of type $blood for a patient (Urgency Level: $level) at $hospital.\n\nContact: $tp\n\nThank you for your support.";
                        $mail->AltBody = "";

                        $mail->send();                        
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
// ***********************************************************************************************************
            header('Location: admin.php?sec=7');
        }
        else{
            header('Location: request.php?s=fail');
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Blood Request</title>
    <script src="script.js" defer></script>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Form Container */
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h2 {
            color: #d9534f;
            margin-bottom: 10px;
        }

        .heart-icon {
            font-size: 50px;
            color: red;
            margin-bottom: 10px;
        }

        .warning {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Submit Button Styling */
        .submit-btn {
            background: #e63946;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }

        .submit-btn:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div id="navbar"></div>

    <!-- Emergency Blood Request Form -->
    <div class="container">
        <div class="heart-icon">❤️</div>
        <h2>Emergency Blood Request</h2>
        <p>Please fill all required fields</p>

        <p class="warning">⚠ For immediate emergencies, please call your local emergency services or hospital directly while submitting this form.</p>

        <form method="post" action="request.php">
            
            <label for="blood-type">Blood Type Required *</label>
            <select id="blood-type" name="bloodtype" required>
                <option value="">Select blood type</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>

            <label for="hospital">Hospital/Clinic Name *</label>
            <input type="text" id="hospital" name="hospital" value="<?=$_SESSION['hospital']?>" required disabled>

            <label for="urgency">Urgency Level *</label>
            <select id="urgency" name="urgency" required>
                <option value="">Select urgency level</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <label for="district">Select District:</label>
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

            <label for="contact">Contact Number *</label>
            <input type="text" id="contact" name="contact" required>

            <!-- Corrected submit button -->
            <button type="submit" class="submit-btn" name="submit">Submit Blood Request</button>
        </form>
    </div>

    <div id="footer"></div>

</body>
</html>
