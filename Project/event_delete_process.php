<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['type']) && !empty($_GET['type'])){
        $type = $_GET['type'];
        $event_id = $_GET['event_id'];

        if($type == "delete"){
            $process = "DELETE FROM event
                        WHERE event_id = $event_id";

            if(mysqli_query($combine_data, $process)){
                // Success
                echo "<script>alert('Hide Event Success.'); window.location.href='admin_event_manage.php';</script>";
            }
            else {
                // Error
                echo "<script>alert('Error! Hide Event Not Success.'); window.location.href='admin_event_manage.php';</script>";
            }
        }else{
            echo "<script>alert('Error! Event ID not provided.'); window.location.href='admin_event_manage.php';</script>";
        }
    }else{
        if(isset($_GET['event_id']) && !empty($_GET['event_id'])){

            $event_id = mysqli_real_escape_string($combine_data, $_GET['event_id']);
    
            // Hide event
            $process = "UPDATE event SET show_event = '1' WHERE event_id = '$event_id'";
    
            if(mysqli_query($combine_data, $process)){
                // Success
                echo "<script>alert('Hide Event Success.'); window.location.href='admin_event_manage.php';</script>";
            }
            else {
                // Error
                echo "<script>alert('Error! Hide Event Not Success.'); window.location.href='admin_event_manage.php';</script>";
            }
        }
        else {
            echo "<script>alert('Error! Event ID not provided.'); window.location.href='admin_event_manage.php';</script>";
        }
    }
?>
