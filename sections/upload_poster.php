<?php
include('../include/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $camp_date = $_POST['camp_date'];
    $location_link = $_POST['location_link'];
    
    // File upload settings
    $target_dir = "uploads/";
    $poster_name = basename($_FILES["poster"]["name"]);
    $target_file = $target_dir . time() . "_" . $poster_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["poster"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Allow only image formats (JPG, PNG, JPEG, GIF)
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Upload file if no errors
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO poster(path,location,date) VALUES('$target_file','$location_link','$camp_date')";
            $r = mysqli_query($connection,$query);
            if($r)
            {
                header('Location: ../admin.php?sec=5');
                exit();
            }
            
        } else {
            echo "Error uploading poster.";
        }
    }
}
?>
