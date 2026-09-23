<!-- Blood Management  -->

<?php
    session_start();
    $semail = "";
    $error = "";
    isset($_SESSION['email']) ? $semail = $_SESSION['email'] : header('Location: login.php');
    ($_SESSION['role']=='user') ? header('Location: login.php') : $role = $_SESSION['role']; 
    $hospital = $_SESSION['hospital'];
    include(__DIR__ . '/../include/connection.php');
    
    
?>

<?php

    // add withdrawal 
    if(isset($_POST['sub']))
    {
        $type = mysqli_real_escape_string($connection,$_POST['type']);
        $btype = mysqli_real_escape_string($connection,$_POST['btype']);
        $vol = mysqli_real_escape_string($connection,$_POST['vol']);
        $reason = mysqli_real_escape_string($connection,$_POST['reason']);
        $patient = mysqli_real_escape_string($connection,$_POST['patient']);
        $date = mysqli_real_escape_string($connection,$_POST['date']);

        $q = "INSERT INTO withdrawal(type,btype,vol,reason,patient,date,email,hospital) values('$type','$btype',$vol,'$reason','$patient','$date','$semail','$hospital')";
        
        try {
            $r = mysqli_query($connection,$q);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if($r)
        {
            header("Location: ../admin.php?sec=8");
        }        
    }

    
    //show record 

    $code = "";
    $fdate = date("Y-m-d");
    if(isset($_GET['date']))
    {        
        $fdate = empty($_GET['date']) ? date("Y-m-d") : $_GET['date'];        
    }  
    
    $q = "SELECT * FROM withdrawal WHERE date='$fdate'";
    $r = mysqli_query($connection,$q);
    if($r)
    {
        while($rec = mysqli_fetch_assoc($r))
        {
            $code .= "<tr><td>".$rec['id']."</td>";
            if($rec['type'] == 'Blood') 
            {
                $code .= "<td>".$rec['type']." - ".$rec['btype']."</td>";
            }else $code .= "<td>".$rec['type']."</td>";
            
            $code .= "<td>".$rec['vol']."</td>";
            $code .= "<td>".$rec['date']."</td>";
            $code .= "<td>".$rec['reason']."</td>";
            $code .= "<td>".$rec['patient']."</td></tr>" ;
        }
    }

?>




<div class="blood-usage-container">
    <h2>Record Blood & Plasma Usage</h2>
    <form method="post" action="sections/section8.php">
        <div class="form-group">
            <label for="usageType">Usage Type</label>
            <select id="usageType" name="type" required>
                <option value="Blood">Blood</option>
                <option value="Plasma">Plasma</option>
                <option value="Platelet">Platelet</option>
            </select>
        </div>

        <!-- Blood Type Dropdown (Initially Hidden) -->
        <div class="form-group" id="bloodTypeGroup" style="display: none;">
            <label for="bloodType">Blood Type</label>
            <select id="bloodType" name="btype">
                <option value="Null">--Please Select--</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount Used (ml)</label>
            <input type="number" id="amount" name="vol" required min=100 max=500 placeholder="100-500 ml">
        </div>

        <div class="form-group">
            <label for="reason">Reason</label>
            <input type="text" name="reason" placeholder="Reason">
        </div>

        <div class="form-group">
            <label for="patient">Patient</label>
            <input type="text" name="patient" placeholder="Name - Contact Number">
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </div>

        <button type="submit" class="button" name="sub" >Record Usage</button>
    </form>

<script>
    // JavaScript to show/hide the Blood Type field based on the selected usage type
    document.getElementById("usageType").addEventListener("change", function() {
        var bloodTypeGroup = document.getElementById("bloodTypeGroup");
        if (this.value === "Blood") {
            bloodTypeGroup.style.display = "block"; // Show blood type field
        } else {
            bloodTypeGroup.style.display = "none"; // Hide blood type field
        }
    });
</script>


    <h2>Usage Records</h2>
    <div class="form-group">
        <label for="filterDate">Filter by Date</label>
        <input type="date" id="filterDate" name="date2">
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Amount (ml)</th>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>Patient</th>

                </tr>
            </thead>
            <tbody id="usageTable">
            <?php
                    if(empty($code)) echo "<tr><td colspan=\"6\">No records found</td></tr>";
                    else echo $code;
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.querySelector("input[name='date2']").addEventListener("change", function() {
            let selectedDate = this.value;

            if (selectedDate) {
                // Construct the new URL with sec=2 and selected date
                let newUrl = `admin.php?sec=8&date=${selectedDate}`;

                // Reload the page with the new URL
                window.location.href = newUrl;
            }
        });
    </script>

    <style>
        .blood-usage-container {
            width: 100%;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .blood-usage-container h2 {
            text-align: center;
            color: #d9534f;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .blood-usage-container .form-group {
            margin-bottom: 15px;
        }

        .blood-usage-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .blood-usage-container input,
        .blood-usage-container select,
        .blood-usage-container .button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .blood-usage-container button {
            background: #d9534f;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .blood-usage-container button:hover {
            background: #c9302c;
        }

        .blood-usage-container .table-container {
            margin-top: 20px;
            overflow-x: auto;
            width: 100%;
        }

        .blood-usage-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .blood-usage-container th, 
        .blood-usage-container td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .blood-usage-container th {
            background: #d9534f;
            color: white;
        }

        /* Make sure this page adapts to sidebar toggle state */
        @media screen and (max-width: 768px) {
            .blood-usage-container th, 
            .blood-usage-container td {
                padding: 8px;
                font-size: 14px;
            }
            
            .blood-usage-container {
                padding: 10px;
            }
        }
    </style>
</div>