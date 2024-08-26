<?php
session_start();

    include('connection.php');
    include('admin_check.php');

    if(isset($_GET['no_history'])){
        $no_history = $_GET['no_history'];

        // Delete event
        $process = "DELETE FROM event_approve
                    WHERE no_history = '$no_history'";

        $file = 'UPLOAD/Event/PDF/' . $no_history . '.pdf'; 

        unlink($file);

        if(mysqli_query($combine_data, $process)){
            // Success
            echo "<script>alert('Delete Event Record Success.'); window.location.href='admin_event_attendance.php';</script>";
        }
        else {
            // Error
            echo "<script>alert('Error! Delete Event Not Success.'); window.location.href='admin_event_attendance.php';</script>";
        }


    }else{
        if(isset($_GET['all_history'])){

            $sql = "SELECT * FROM event_approve WHERE admin_approve = '1'";
            $result = mysqli_query($combine_data, $sql);
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $no_history = $row['no_history']; 

                    $file = 'UPLOAD/Event/PDF/' . $no_history . '.pdf'; 
    
                    unlink($file);
                }
            }

            $process = "DELETE FROM event_approve
            WHERE admin_approve = '1'";

            if(mysqli_query($combine_data, $process)){
                // Success
                echo "<script>alert('Delete All Approved Event Record Success.'); window.location.href='admin_event_attendance.php';</script>";
            }
            else {
                // Error
                echo "<script>alert('Error! Delete Not Success.'); window.location.href='admin_event_attendance.php';</script>";
            }
        }else{
            echo "<script>history.go(-1);</script>";
        }
    }
    
?>