<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    
    
    
?>

<?php
    include(__DIR__ . '/../include/connection.php');
    
    $staffmail = $_SESSION['email'];
    
    // display confirmations 
    $query = "SELECT a.id,a.user,a.type,a.date,a.status,u.name FROM appointment a JOIN user u ON a.user=u.email WHERE a.status='pending' ORDER BY a.date";
    $code = "";
    $r = mysqli_query($connection,$query);
    
    if($r)
    {
        while($rec = mysqli_fetch_assoc($r))
        {
            $code .= "<tr>
            <td>{$rec['id']}</td>
            <td>{$rec['name']}</td>
            <td>{$rec['type']}</td>
            <td>{$rec['user']}</td>
            <td>{$rec['date']}</td>
            <td>
                <a href=\"admin.php?sec=2&scon={$rec['id']}\" style=\"text-decoration: none; color: black; font-size: 18px;\">✅️</a> 
                <a href=\"admin.php?sec=2&scan={$rec['id']}\" style=\"text-decoration: none; color: red; font-size: 18px;\">❌</a>
            </td>
          </tr>";

                  
            
        }
    }

?>

<!-- manage get variables  -->
<?php

    $queryg="";
    $code2 = "";
    $dateget = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
    
    $querydate = "SELECT a.id,a.user,a.type,a.date,a.status,u.name FROM appointment a JOIN user u ON a.user=u.email WHERE (a.status='queued' and date='$dateget' and a.staff='$staffmail') ORDER BY a.date";
    $rdate = mysqli_query($connection,$querydate);
    if($rdate)
    {
        
        while($rec = mysqli_fetch_assoc($rdate))
        {            
            $code2 .= "<tr>
            <td>{$rec['id']}</td>
            <td>{$rec['name']}</td>
            <td>{$rec['type']}</td>
            <td>{$rec['user']}</td>
            <td>{$rec['date']}</td>
            <td>
                <a href=\"admin.php?sec=2&done={$rec['id']}\" style=\"text-decoration: none; color: black; font-size: 18px;\">✅️</a>                 
            </td>
          </tr>";

        }
    }

    if(isset($_GET['scon']))
    {
        $id = $_GET['scon'];
        $queryg = "UPDATE appointment set status='queued',staff='$staffmail' WHERE id=$id";
        $r = mysqli_query($connection,$queryg);
        if($r)
        {
            header('Location: admin.php?sec=2');
            exit();
        }
    }

    if(isset($_GET['scan']))
    {
        $id = $_GET['scan'];
        $queryg = "UPDATE appointment set status='canceled' WHERE id=$id";
        $r = mysqli_query($connection,$queryg);
        if($r)
        {
            header('Location: admin.php?sec=2');
            exit();
        }
    }

    if(isset($_GET['done']))
    {
        $id = $_GET['done'];
        $queryg = "UPDATE appointment set status='completed' WHERE id=$id";
        $r = mysqli_query($connection,$queryg);
        if($r)
        {
            header('Location: admin.php?sec=2');
            exit();
        }
    }

    

    

    


    
?>



<h2>Appointments</h2>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?=$code?>
        </tbody>
    </table>
</div>

<h2>Search By Date</Search></h2>

            <div class="mb-3">
                <label class="form-label">Select Date</label>
                <input type="date" class="form-control" name="date" required>                
            </div>


<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?=$code2?>          
        </tbody>
    </table>
    <script>
        document.querySelector("input[name='date']").addEventListener("change", function() {
            let selectedDate = this.value;

            if (selectedDate) {
                // Construct the new URL with sec=2 and selected date
                let newUrl = `admin.php?sec=2&date=${selectedDate}`;

                // Reload the page with the new URL
                window.location.href = newUrl;
            }
        });
    </script>


</div>
