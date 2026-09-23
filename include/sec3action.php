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
                        echo "registerd success";                     
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