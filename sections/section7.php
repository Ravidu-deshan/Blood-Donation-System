<!-- Request History  -->


<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    include(__DIR__ . '/../include/connection.php');
    
    
?>

<?php
    // delete request 
    if(isset($_GET['chng']))
    {
        $id = $_GET['chng'];
        $q = "UPDATE request SET status='closed' WHERE id=$id";
        $r = mysqli_query($connection,$q);
        if($r==1)
        {
            header('Location: admin.php?sec=7');
        }
    }

    //load data
    $q = "SELECT * FROM request WHERE hospital = '{$_SESSION['hospital']}' AND status = 'pending'";
    $r = mysqli_query($connection,$q);
    $code = "";
    if($r)
    {
        while($rec = mysqli_fetch_assoc($r))
        {
            $code .= "<tr><td>".$rec['id']."</td>";
            $code .= "<td>".$rec['blood']."</td>";
            $code .= "<td>".$rec['date']."</td>";
            $code .= "<td><span class=\"urgency ".$rec['level']."\">".$rec['level']."</span></td>";
            $code .= "<td><button class=\"cancel-btn\"><a href=\"admin.php?sec=7&chng=".$rec['id']."\" class=\"no-style\">Cancel</a></button></td></tr>";
        }
    }


?>




<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Date</th>
                <th>Urgency Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?=$code?>
        </tbody>
    </table>
</div>

<style>
.table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.table th, .table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.urgency {
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
}

.Low { background-color: #28a745; color: white; }  /* Green */
.Medium { background-color: #ffc107; color: black; } /* Yellow */
.High { background-color: #dc3545; color: white; }   /* Red */

.cancel-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.cancel-btn:hover {
    background: #a71d2a;
}

.no-style {
    text-decoration: none;
    color: inherit;
}

@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
    .table th, .table td {
        font-size: 14px;
        padding: 8px;
    }
}
</style>
