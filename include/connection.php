<?php

    $connection = mysqli_connect('localhost','root','','blood',3306);

    if(mysqli_connect_errno())
    {
        die("connection failed ".mysqli_connect_error());
    }
    //  else echo 'yes';


?>