<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['no_history']) && isset($_GET['member_id'])) {
        // Get the no_history from the URL
        $member_id = $_GET['member_id'];
        $no_history = $_GET['no_history'];

        $approve_datetime = date("Y-m-d h:i:s");
    
        $process = "UPDATE gift_approve
        SET admin_id     = '".$_SESSION['nokp']."',
            approve = '1',
            approve_datetime = '".$approve_datetime."'
        WHERE no_gift_history = '".$no_history."'";

        if(mysqli_query($combine_data, $process)) {
            echo "<script>alert('Approve Success.');
            window.location.href='gift_history.php';</script>";
        }
        else
        {
            echo "<script>alert('Error! Approve Not Success.');
            window.location.href='gift_history.php';</script>";
        }
    }else{
        echo "<script>alert('Error! Data Not Found.'); window.location.href='index.php';</script>";
    }

?>
