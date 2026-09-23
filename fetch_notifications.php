<?php
include('include/connection.php');
session_start();

$email = "";
if (!isset($_SESSION['email'])) {
    http_response_code(403);
    echo "Unauthorized";
    exit;
}

$q = "SELECT * FROM request WHERE status='pending'";
$r = mysqli_query($connection, $q);
$notifications = [];

if ($r) {
    while ($rec = mysqli_fetch_assoc($r)) {
        $notifications[] = [
            'blood' => $rec['blood'],
            'hospital' => $rec['hospital'],
            'level' => $rec['level'],
            'date' => $rec['date'],
            'tp' => $rec['tp']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($notifications);
?>
