<?php
    session_start();
    include('user_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
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
        <h1>Event List</h1>

        <form action="" method="POST">
            <label for="event_name">Event Name : </label>
            <input type="text" id="event_name" name="event_name">

            <br><br>

            <label for="type_select">Event Type : </label>
            <input type="radio" id="online" name="type_select" value="2">
            <label for="online">Online</label>
            <input type="radio" id="offline" name="type_select" value="1">
            <label for="offline">Offline</label>
            <input type="radio" id="system" name="type_select" value="3">
            <label for="system">System Update</label>
            
            <br><br>
            
            <input type="submit" value="Search">
            <input type="button" value="Reset Filter" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

        <br>

            <?php

                $sql = "SELECT * FROM event WHERE 1";

                // Check for event type filter
                if(isset($_POST['type_select']) && !empty($_POST['type_select'])) {
                    $event_type = $_POST['type_select'];
                    $sql .= " AND event_type = $event_type";
                }

                // Check for event name search
                if(isset($_POST['event_name']) && !empty($_POST['event_name'])) {
                    $search_name = $_POST['event_name'];
                    $sql .= " AND event_name LIKE '%$search_name%'";
                }

                $sql .= " ORDER BY event_type";

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['event_id'];
                        $name = $row['event_name'];
                        $type = $row['event_type'] ;
                        $description = $row['event_description'];
                        $location = $row['event_location'];
                        $date = $row['event_date'];

                        if($type == "2"){
                            $type = "Online";
                            echo "<div>
                            <h3>(ONLINE EVENT) : <u>$name</u></h3>
                            <p>Event Date : $date</p>
                            <div class='display_line'></div>
                            <p>$description</p>
                            <button onclick=\"location.href='user_event_list.php?event_id=$id'\">Click To Join!</button>
                        </div><br>";

                        }else if ($type == "3"){
                            $type = "System Update";
                            echo "<div>
                            <h3>(SYSTEM UPDATE) : <u>$name</u></h3>
                            <div class='display_line'></div>
                            <p>$description</p>
                        </div><br>";

                        }else{
                            $type = "Offline";
                            echo "<div>
                            <h3>(OFFLINE EVENT) : <u>$name</u></h3>
                            <p>Event Date : $date</p>
                            <div class='display_line'></div>
                            <p>Event Location : $location</p>
                            <p>$description</p>
                            <button onclick=\"location.href='user_event_list.php?event_id=$id'\">Click To Join!</button>
                        </div><br>";
                        }
                    }
                } else {
                    echo "<div>No events found.</div>";
                }
            ?>
    </div>
</body>

<?php
    include('footer.php');
?>