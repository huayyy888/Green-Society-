<?php
    session_start();
    include('user_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
    <style>
        .body_location {
    padding: 20px;
}


.body_location h1 {
    color: black; 
}


.body_location form {
    margin-bottom: 20px;
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

.body_location input[type="button"] {
    background-color: #808080; 
    color: white; 
    border: none;
    cursor: pointer;
    margin-bottom: 10px;
}

.body_location table {
    width: 100%;
    border-collapse: collapse;
}


.body_location table th {
    background-color: #4CAF50;
    color: white; 
    padding: 10px;
    text-align: left;
}

.body_location table td {
    border: 1px solid #ddd;
    padding: 8px;
}


        </style>
</head>

<body>

    <?php 
        if(isset($_GET['event_id'])) {
            // Get the event_id from the URL
            $event_id = $_GET['event_id'];
    
            echo "<script>location.href='event_details.php?event_id=$event_id'</script>";
        }
    ?>

    <div class="body_location">
        <h1>Event History</h1>

        <form action="" method="POST">
            <label for="event_name">Event Name : </label>
            <input type="text" id="event_name" name="event_name">
            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

            <table border="1" width="100%">
                <tr>
                    <td>No</td>
                    <td>Event Name</td>
                    <td>Datetime</td>
                </tr>

            <?php
                $member_id = $_SESSION['nokp'];
                $sql = "SELECT event_join.datetime_join, event.event_name 
                        FROM event_join
                        INNER JOIN member ON event_join.member_nokp = member.member_nokp 
                        INNER JOIN event ON event_join.event_id = event.event_id 
                        WHERE event_join.member_nokp = $member_id";

                // Check for event name search
                if(isset($_POST['event_name']) && !empty($_POST['event_name'])) {
                    $search_name = $_POST['event_name'];
                    $sql .= " AND event_name LIKE '%$search_name%'";
                }

                $bil=0;
                
                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['event_name'];
                        $date = $row['datetime_join'];

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $name ."</td>
                                <td>". $date ."</td>
                              </tr>";
                    }
                }else{
                    echo "<tr>
                            <td colspan='3'>No history data</td>
                        </tr>";
                }
            ?>
            </table>
    </div>
</body>

<?php
    include('footer.php');
?>