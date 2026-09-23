<!-- Add hospital  -->


<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    
    
    if ($role == 'hospital') {
         
    } else {
        header('Location: admin.php');
    }
   
    
    include(__DIR__ . '/../include/connection.php');
    
    
?>

<?php
    if(isset($_POST['registerBtn']))
    {
        $name   = mysqli_real_escape_string($connection,$_POST['name']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $address = mysqli_real_escape_string($connection,$_POST['address']);
        $tp = mysqli_real_escape_string($connection,$_POST['tp']);
        $district = mysqli_real_escape_string($connection,$_POST['district']);
        $pass = sha1("123");

        $q = "INSERT INTO hospital(name,email,address,tp) VALUES('$name','$email','$address','$tp')";
        $q1 = "INSERT INTO user(email,pass,name,uname,tp,district,hospital,role) VALUES('$email','$pass','$name','$name','$tp','$district','$name','hospital')";
        
        $r = mysqli_query($connection,$q);
        if($r)
        {
            $r1 = mysqli_query($connection,$q1);
            ($r1) ? header('Location: ../admin.php?sec=9') : header('Location: ../admin.php?sec=9&msg=err');
        }
    }



?>

<h2>Add Hospital or Blood Bank</h2>
<form action="sections/section9.php" method="POST">

    <label for="name">Hospital Name:</label>
    <input type="text" id="name" name="name" class="form-control" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required>

    <label for="username">Address:</label>
    <input type="text" id="address" name="address" class="form-control" required>

    <label for="username">District:</label>
    <input type="text" id="district" name="district" class="form-control" required>

    <label for="tp">Telephone:</label>
    <input type="text" id="tp" name="tp" class="form-control" required>
    

    <button type="submit" class="btn btn-danger mt-3" name="registerBtn">Submit</button>
</form>