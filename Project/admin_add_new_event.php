<?php
    session_start();
    include('header.php');
    include('connection.php');
    include('admin_check.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_add_new_event.css">
    <style>
        .body_location {
            padding: 20px;
            margin-top: 50;
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

        input[type="submit"]:hover,input[type="button"]:hover,button:hover{
            background-color: #45a049; 
            /* Darker green on hover */
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

        .body_location label[for="online"],.body_location label[for="offline"],.body_location label[for="system"],.body_location label[for="Click_Button"]{
            font-style: oblique;
        }
</style>

</head>

<div class="body_location">
    <button onclick="location.href='admin_event_manage.php';" title="Back to Member Management"><i class="fa-solid fa-circle-left"></i> Back</button>

    <form action="admin_add_new_event_process.php" method="post" enctype="multipart/form-data">
    
        <h1>Add New Event</h1>
        <div>
            <label>Event Type : </label>
            <input type="radio" id="online" name="type_select" value="2" required>
            <label for="online">Online</label>
            <input type="radio" id="offline" name="type_select" value="1">
            <label for="offline">Offline</label>
            <input type="radio" id="system" name="type_select" value="3">
            <label for="system">System Update</label>
        </div>
        <br><br>

        <label>Event Join Type : </label>
        <input type="radio" id="Click_Button" name="type_join" value="1" required>
        <label for="Click_Button">Click to Join</label>
        <input type="radio" id="System" name="type_join" value="4">
        <label for="System">System</label>

        <br><br>
        
        <label for="eventID">Event ID :</label>
            
        <input type="text" name="eventID" id="eventID" placeholder=" without '-'" value="" required>

        <br><br>

        <label for="eventName">Event Name : </label>
        <input type="text" name="eventName" id="eventName" value="" required>

        <br><br>

        <label for="eventDate">Event Date : </label>
        <input type="date" name="eventDate" id="eventDate" value="" required>

        <br><br>
        
        <label for="eventDescription" class="text_label">Description : </label>
        <textarea maxlength='200' name='eventDescription' id='eventDescription' rows='10' cols='60' style='max-width: 616px;' required></textarea>

        <br><br>

        <label for="eventLocation" class="text_label">Location : </label>
        <textarea maxlength='200' name='eventLocation' id='eventLocation' rows='10' cols='60' style='max-width: 616px;'></textarea>

        <br><br>

        <input class="button" type="submit" value="Add" name="Add">
        <input class="button" type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

    </form>

</div>

<?php
    include('footer.php');
?>