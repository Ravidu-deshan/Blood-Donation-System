<?php
    include('../include/connection.php');
    session_start();
    $email = "";
    $error = "";
    isset($_SESSION['email']) ? $email = $_SESSION['email'] : header('Location: ../login.php');
?>

<!-- details auto fill  -->
<?php

    $query = "SELECT * from donor where email = '$email'";
    $r = mysqli_query($connection,$query);
    $blood = "";
    $weight = "";
    $hospital = "";
        
    if($r)
    {
        
        while($record = mysqli_fetch_assoc($r))
        {
            $blood = $record['blood'];
            $weight = $record['weight'];
            
            
        }

        
    }

?>

<!-- change details  -->
<?php

if(isset($_POST['fupbtn']))
{
    
    $fblood = mysqli_real_escape_string($connection,$_POST['blood']);
    $fweight = mysqli_real_escape_string($connection,$_POST['weight']);
    $fhospital = mysqli_real_escape_string($connection,$_POST['hospital']);
 
    $query_donor = "UPDATE donor SET blood = '$fblood',weight='$fweight' WHERE email = '$email'";
    $r = mysqli_query($connection, $query_donor);
    
    header('Location: index.php?sec=2');
    exit();
    
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
            document.getElementById("blood_type").removeAttribute("disabled");
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
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center text-danger">Health Details</h2>
    
    <div class="card">
        <form method="post" action="health.php">
            <div class="mb-3">
                <label class="form-label">Blood Type</label>
                <!-- <input type="text" class="form-control user-input" name="blood" value="<?=$blood ?>" readonly> -->
                <select id="blood_type" name="blood" class="form-control" disabled id="blood_type">
                    <option value="A+" <?= ($blood == 'A+') ? 'selected' : '' ?>>A+</option>
                    <option value="A-" <?= ($blood == 'A-') ? 'selected' : '' ?>>A-</option>
                    <option value="B+" <?= ($blood == 'B+') ? 'selected' : '' ?>>B+</option>
                    <option value="B-" <?= ($blood == 'B-') ? 'selected' : '' ?>>B-</option>
                    <option value="O+" <?= ($blood == 'O+') ? 'selected' : '' ?>>O+</option>
                    <option value="O-" <?= ($blood == 'O-') ? 'selected' : '' ?>>O-</option>
                </select>

            </div>

            <div class="mb-3">
                <label class="form-label">Weight</label>
                <input type="text" class="form-control user-input" name="weight" value="<?=$weight ?>" readonly>
            </div>

            
            
            <button type="button" class="btn btn-danger w-100" id="editBtn" onclick="enableEdit()">Edit</button>
            <button type="submit" class="btn btn-success w-100 mt-2" id="updateBtn" name="fupbtn" style="display:none;">Update</button>
        </form>
    </div>
</div>

</body>
</html>
