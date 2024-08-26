<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['event_id']) && !empty($_GET['event_id'])){

        $event_id = mysqli_real_escape_string($combine_data, $_GET['event_id']);

        // Delete event
        $process = "UPDATE event SET show_event = '0' WHERE event_id = '$event_id'";

        if(mysqli_query($combine_data, $process)){
            // Success
            echo "<script>alert('Show Back Event Success.'); window.location.href='admin_event_manage.php';</script>";
        }
        else {
            // Error
            echo "<script>alert('Error! Show Back Event Not Success.'); window.location.href='admin_event_manage.php';</script>";
        }
    }
    else {
        echo "<script>alert('Error! Event ID not provided.'); window.location.href='admin_event_manage.php';</script>";
    }
?>
