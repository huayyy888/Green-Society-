<?php
    session_start();

    if(empty($_POST))
    {
        die("<script>alert('Error! Data Not Found.');
        window.location.href='index.php';</script>");
    }

    include('connection.php');

    $check_data_query = "SELECT * FROM event WHERE event_id = '" . $_POST['eventID'] . "'";
    $check_data_result = mysqli_query($combine_data, $check_data_query);

    if (mysqli_num_rows($check_data_result) > 0) {
        echo "<script>alert('Item ID already registered.');
        history.go(-1);</script>";
    } else {
        $process = "INSERT INTO event (event_id, event_name, event_description, event_location, event_date, event_type, event_join_type, fix)
        VALUES ('" . $_POST['eventID'] . "','" . $_POST['eventName'] . "','" . $_POST['eventDescription'] . "','" . $_POST['eventLocation'] . "','" . $_POST['eventDate'] . "','" . $_POST['type_select'] . "','" . $_POST['type_join'] . "','0')";

        if (mysqli_query($combine_data, $process)) {
            echo "<script>alert('Success Adding Item.'); window.location.href='admin_event_manage.php';</script>";
        } else {
            echo "<script>alert('Error! Adding Item not success.');
            history.go(-1);</script>";
        }
    }

?>