<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    
    
    
?>
<h2>Upload Blood Donation Camp Poster</h2>
<form action="sections/upload_poster.php" method="POST" enctype="multipart/form-data" class="mt-4">
    <div class="mb-3">
        <label for="camp_date" class="form-label">Camp Date</label>
        <input type="date" class="form-control" id="camp_date" name="camp_date" required>
    </div>
    
    <div class="mb-3">
        <label for="location_link" class="form-label">Location Link</label>
        <input type="url" class="form-control" id="location_link" name="location_link" placeholder="https://maps.google.com/..." required>
    </div>

    <div class="mb-3">
        <label for="poster" class="form-label">Upload Poster</label>
        <input type="file" class="form-control" id="poster" name="poster" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-danger">Upload Poster</button>
</form>
