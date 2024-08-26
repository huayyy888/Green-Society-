<?php
    session_start();
    include('user_check.php');
    include('header.php');
    include('connection.php');
?>

<head>
    <style>

.body_location {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f0f0f0; 
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
}

.body_location button {
    background-color: #ccc; 
    color: #333; 
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.body_location button:hover {
    background-color: #bbb; 
}

.body_location button[type="submit"] {
    background-color: #4CAF50; 
    color: #fff; 
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.body_location button[type="submit"]:hover {
    background-color: #45a049; 
}


.body_location h1 {
    text-align: center;
    margin-bottom: 20px;
    color: black; 
}


.body_location p {
    margin-bottom: 15px;
    color: #333; 
}

.body_location form {
    margin-top: 20px;
}

.body_location label {
    display: block;
    font-weight: bold;
    color: #333; 
}

.body_location input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc; 
    border-radius: 5px;
    box-sizing: border-box; 
}

.join_btn{
    margin-left: 500px;
}

        </style>
</head>

<body>

    <?php 
    if(isset($_GET['event_id'])){
        // Fetch user details based on member_id
        $event_id = $_GET['event_id'];

        $sql = "SELECT * FROM event WHERE event_id = '$event_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $id = $row['event_id'];
            $name = $row['event_name'];
            $type = $row['event_type'];
            $join_type = $row['event_join_type'];
            $description = $row['event_description'];
            $location = $row['event_location'];
            $date = $row['event_date'];
        }

        if($type == "3"){
            echo "<script>history.go(-1);</script>";
        }
        
    }else{
            echo "<script>history.go(-1);</script>";
        }
    ?>

    <div class="body_location">

        <button onclick="location.href='event_list.php'" title="Back to Event List"><i class="fa-solid fa-circle-left"></i> Back</button>

        <h1><u><?php echo $name ?></u></h1>

        <p>Event Date : <?php echo $date ?></p>

        <p><?php echo $description ?></p>

        <!-- Location -->

        <?php
            if($type == "1"){
                echo "<p>Location : ". $location ."</p>";
            }
        ?>

        <!-- form -->

        <?php
            if($join_type == "2"){
                echo "
                    <form action='join_event_process.php?event_id=$id&type=$join_type' onsubmit=\"return confirm('Confirm want to upload the file?');\" enctype='multipart/form-data' method='POST'>
                        <label for='admin_picture'>Upload Document to Join (Only JPG and PNG are allowed.)</label>
                        <br><br>
                        <div class='upload_picture_location'>
                            <div>
                                <input type='hidden' name='MAX_FILE_SIZE' value='2097152' />
                                <input id='admin_picture' type='file' name='file' accept='image/jpeg, image/png' onchange='updateText()' required/>
                            </div>
                            <br>
                            <button type='submit'>Upload and Join Event</button>
                        </div>
                    </form>
                ";
            }else if($join_type == "1"){
                // JOIN TYPE == 1
                ?><br><?php
                echo "<button class='join_btn' onclick=\"if(confirm('Press OK to confirm joining the event.')) window.location.href = 'join_event_process.php?event_id=$id&type=$join_type';\">Join Event</button>";
            }else if($join_type == "3"){
                ?><br><?php
                echo "<script>window.location.href='user_event$id.php';</script>";
            }
        ?>

    </div>
</body>

<?php
    include('footer.php');
?>