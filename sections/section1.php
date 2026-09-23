<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    
    
    
?>

<?php
    
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
<?php $error = isset($_GET['err']) ? $_GET['err'] : ''; ?>
<h2>Add a New Donor</h2>
<small id="passwordError" class="text-danger"><?= ($error=='ee') ? 'Email already exist !': '' ?> </small>
<form action="include/sec1action.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" class="form-control" required>
                                                                                    
    <label for="name">Username:</label>
    <input type="text" id="uname" name="uname" class="form-control" required>
    
    <label for="name">Address:</label>
    <input type="text" id="address" name="address" class="form-control" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required>
    
    <label for="name">Telephone:</label>
    <input type="text" id="tp" name="tp" class="form-control" required>
    
    <label for="hospital">Hospital:</label>
    <select id="hospital" name="hospital" class="form-control">
        <?=$code?>
             
    </select>

    <label for="blood_type">Blood Type:</label>
    <select id="blood_type" name="blood_type" class="form-control">
        <option>A+</option>
        <option>A-</option>
        <option>B+</option>
        <option>B-</option>
        <option>O+</option>
        <option>O-</option>
    </select>

    <label for="name">Weight:</label>
    <input type="text" id="weight" name="weight" class="form-control" required>


    

    <button type="submit" class="btn btn-danger mt-3" name="registerBtn">Submit</button>
</form>

