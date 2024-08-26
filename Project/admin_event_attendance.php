<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
    <style>
            .body_location {
                padding: 20px;
            }

            .body_location input[type="text"],
            .body_location input[type="submit"],
            .body_location input[type="button"] {
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }


            .body_location input[type="submit"] {
                background-color: #4CAF50; 
                color: white; 
                border: none;
                cursor: pointer;
            }
            .body_location input[type="submit"]:hover {
    background-color: #45a049; 
}
            .body_location input[type="button"] {
                background-color: #808080; 
                color: white; 
                border: none;
                cursor: pointer;
                margin-bottom: 10px;
            }

            .body_location input[type="button"]:hover { 
        background-color: #666666; 
    }
            
            .body_location button[title='Click to Delete This Event Attendance!'] {
                background-color: #f08080; 
                color: white; 
                border: none;
                cursor: pointer;
                margin-bottom: 10px;
                padding:15px;
                border-radius: 15px;
            }

            .body_location button[title='Click to Delete This Event Attendance!']:hover {
    background-color: #e74c3c; 
}

            .body_location table {
                width: 100%;
                border-collapse: collapse;
            }

            .body_location table td {
                border: 1px solid #ddd;
                padding: 8px;
            }
    </style>
</head>

<body>
    <div class="body_location">
        <h1>Event Attendance</h1>

        <form action="" method="POST">
            <label for="event_name">Event Name : </label>
            <input type="text" id="event_name" name="event_name">
            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

        <br>

        <button onclick="if(confirm('Click OK to delete this event.')) { location.href='event_attendance_delete_process.php?all_history=1'; }" title='Click to Delete This Event Attendance!'>
            <i class="fa-solid fa-user-slash"></i>Delete All Approved User
        </button>

        <br><br>

        <table width='100%' border='1'>
            <tr>
                <td>No</td>
                <td>Member ID</td>
                <td>Event Name</td>
                <td>Register Datetime</td>
                <td>Point Added</td>
                <td>Admin ID</td>
                <td>Approve</td>
                <td>Datetime Approve</td>
                <td>Action</td>
            </tr>

            <?php

                $sql = "SELECT * FROM event_approve INNER JOIN event ON event_approve.event_id = event.event_id WHERE 1";

                // Check for event name search
                if(isset($_POST['event_name']) && !empty($_POST['event_name'])) {
                    $search_name = $_POST['event_name'];
                    $sql .= " AND event_name LIKE '%$search_name%'";
                }

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id_member = $row['member_id']; 
                        $id_event = $row['event_id'];
                        $name = $row['event_name'];
                        $date = $row['register_datetime'];
                        $point = $row['point_added'];
                        $no_history = $row['no_history'];
                        $approve = $row['admin_approve'];
                        
                        if($approve == 1){
                            $approve = "Approved";
                            $approve_button = "";
                            $admin_id = $row['admin_id'];
                            $approve_datetime = $row['approve_datetime'];
                        }else{
                            $approve = "Not Yet Approve";
                            $approve_button = " | <button onclick=\"if(confirm('Click OK to approve this event data.')) { location.href='event_attendance_approve_process.php?no_history=$no_history&member_id=$id_member&point=$point&event_id=$id_event'; }\" title='Click to Approve This Event Attendance!'><i class='fa-solid fa-file-circle-check'></i>Approve</button>";
                            $admin_id = "NULL";
                            $approve_datetime = "NULL";
                        }

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $id_member ."</td>
                                <td>". $name ."</td>
                                <td>". $date ."</td>
                                <td>". $point ."</td>
                                <td>". $admin_id ."</td>
                                <td>" . $approve . $approve_button . "</td>
                                <td>" . $approve_datetime . "</td>
                                <td>
                                    <a href='UPLOAD/Event/PDF/$no_history.pdf' download='$no_history.pdf'><i class='fa-solid fa-download'></i> Download Resit</a>
                                    </button>
                                    |
                                    <button onclick=\"if(confirm('Click OK to delete this event.')) { location.href='event_attendance_delete_process.php?no_history=$no_history'; }\" title='Click to Delete This Event Attendance!'>
                                        <i class='fa-solid fa-trash'></i> Delete
                                    </button>
                                
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No events found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>

<?php
    include('footer.php');
?>