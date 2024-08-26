<?php
    session_start();
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
    <style>
.body_location{
            margin:30px;
        }

.body_location form {
    margin-bottom: 20px;
}

.body_location label {
    font-weight: bold;
}

.reset-btn{
    background-color: grey; 
    color: #fff; 
    border: none;
    margin-right: 10px;
    cursor: pointer;
    border-radius: 5px;
}

.event_list{
    border: 1px solid black;
    padding: 10px;
    border-radius: 10px;
}

.body_location input[type="text"],
.body_location input[type="radio"]{
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

            .body_location input[type="submit"],
            .body_location input[type="button"] {
                padding: 13px;
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
            

.body_location h3 {
    color: black; 
}

.body_location p {
    margin-bottom: 10px;
}

.body_location .display_line {
    border-top: 1px solid #ccc; /* Light grey border */
    margin-bottom: 10px;
}

.body_location button {
    background-color: #4CAF50; /* Green background */
    color: #fff; /* White text color */
    border: none;
    padding: 8px 16px;
    cursor: pointer;
    border-radius: 5px;
}

.body_location button:hover {
    background-color: #45a049; /* Darker green on hover */
}

        </style>
</head>

<body>
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
            <input class ="reset-btn" type="button" value="Reset Filter" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

            <?php

                $sql = "SELECT * FROM event WHERE show_event != 1";

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
                            echo "<div class='event_list'>
                            <h3>(ONLINE EVENT) : <u>$name</u></h3>
                            <p>Event Date : $date</p>
                            <div class='display_line'></div>
                            <p>$description</p>
                            <button onclick=\"location.href='user_event_list.php?event_id=$id'\">Click To Know More!</button>
                        </div><br>";

                        }else if ($type == "3"){
                            $type = "System Update";
                            echo "<div class='event_list'>
                            <h3>(SYSTEM UPDATE) : <u>$name</u></h3>
                            <div class='display_line'></div>
                            <p>$description</p>
                        </div><br>";

                        }else{
                            $type = "Offline";
                            echo "<div class='event_list'>
                            <h3>(OFFLINE EVENT) : <u>$name</u></h3>
                            <p>Event Date : $date</p>
                            <div class='display_line'></div>
                            <p>Event Location : $location</p>
                            <p>$description</p>
                            <button onclick=\"location.href='user_event_list.php?event_id=$id'\">Click To Know More!</button>
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