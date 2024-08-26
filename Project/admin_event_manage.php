<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
    <style>

body, h1, form, table, td, th, input, label, button, a {
    margin: 0;
    padding: 0;
}

h1{
    margin:10px;
    margin-bottom:25px;
    text-align:center;
}

.body_location {
    padding: 20px;
}

form {
    margin-bottom: 20px;
}

label {
    display: inline-block;
    width: 120px;
}

input[type="text"] {
    width: 250px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="radio"] {
    margin-right: 5px;
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
            
table {
    border-collapse: collapse;
    width: 100%;
}


th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}


th {
    background-color: #f2f2f2;
}


button {
    padding: 5px 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}


a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>
    <div class="body_location">
        <h1>Event Management</h1>

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
            <input type="radio" id="all" name="type_select" value="" checked="checked">
            <label for="all">All</label>
            
            <br><br>

            <label for="show_hidden">Show Event : </label>
            <input type="radio" id="hidden" name="show_hidden" value="1">
            <label for="hidden">Already Hidden</label>
            <input type="radio" id="show" name="show_hidden" value="2">
            <label for="show">Not Yet Hidden</label>
            <input type="radio" id="all" name="show_hidden" value="" checked="checked">
            <label for="all">All</label>
            
            <br><br>

            <input type="submit" value="Search">
            <input type="button" value="Reset Filter" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

        <a href="admin_add_new_event.php">[Add New Event]</a>

        <br><br>

        <table width='100%' border='1'>
            <tr>
                <td>No</td>
                <td>ID</td>
                <td>Name</td>
                <td>Event Type</td>
                <td>Action</td>
            </tr>

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

                if(isset($_POST['show_hidden']) && !empty($_POST['show_hidden']))
                {
                    $show_hidden = $_POST['show_hidden'];
                    if($show_hidden == 1){
                        $sql .= " AND show_event != 0";
                    }else if($show_hidden == 2){
                        $sql .= " AND show_event != 1";
                    }
                }

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['event_id'];
                        $name = $row['event_name'];
                        $date = $row['event_date'];
                        $type = $row['event_type'];
                        $fix = $row['fix'];
                        $hidden = $row['show_event'];

                        if($hidden != 1){
                            if($fix == 1){
                                $fix = " |
                                <button onclick=\"if(confirm('Click OK to hide this event.')) { location.href='event_delete_process.php?event_id=$id'; }\" title='Click to Hide This Event!'>
                                    <i class='fa-solid fa-eye-slash'></i>
                                    Hide Event
                                </button>";
                                if($id == "E005"){
                                    $fix .= " | <button onclick=\"location.href='gift_menu.php';\" title='Click to Edit Gift Details!'>
                                    <i class='fa-solid fa-sliders'></i>
                                    Edit Gift Details
                                </button>";
                                }
                            }else{
                                $fix = " |
                                <button onclick=\"if(confirm('Click OK to hide this event.')) { location.href='event_delete_process.php?event_id=$id'; }\" title='Click to Hide This Event!'>
                                    <i class='fa-solid fa-eye-slash'></i>
                                    Hide Event
                                </button>";
                            }
                        }else{
                            if($fix == 1){
                                $fix = " | Already Hide |" . "
                            <button onclick=\"if(confirm('Click OK to show back this event.')) { location.href='event_show_back_process.php?event_id=$id'; }\" title='Click to Show Back This Event!'>
                                    <i class='fa-solid fa-eye'></i>
                                    Show Back
                                </button>";
                                if($id == "E005"){
                                    $fix .= " | <button onclick=\"location.href='gift_menu.php';\" title='Click to Edit Gift Details!'>
                                    <i class='fa-solid fa-sliders'></i>
                                    Edit Gift Details
                                </button>";
                                }
                            }else{
                                $fix = " | Already Hide |" . "
                                <button onclick=\"if(confirm('Click OK to show back this event.')) { location.href='event_show_back_process.php?event_id=$id'; }\" title='Click to Show Back This Event!'>
                                    <i class='fa-solid fa-eye'></i>
                                    Show Back
                                </button>
                                |
                                <button onclick=\"if(confirm('Click OK to delete this event.')) { location.href='event_delete_process.php?event_id=$id&type=delete'; }\" title='Click to Detele This Event!'>
                                    <i class='fa-solid fa-trash'></i>
                                    Delete
                                </button>";
                            }
                        }

                        if($type == "2"){
                            $type = "Online";
                        }else if ($type == "3"){
                            $type = "System Update";
                        }else{
                            $type = "Offline";
                        }

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $id ."</td>
                                <td>". $name ."</td>
                                <td>". $type ."</td>
                                <td>
                                    <button onclick=\"location.href='event_edit_menu.php?event_id=" .$id."'\">
                                        <i class='fa-solid fa-magnifying-glass'></i>
                                        Edit
                                    </button> " . $fix . "
                                    
                                
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No events found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>

<?php
    include('footer.php');
?>