<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['no_history']) && isset($_GET['point']) && isset($_GET['member_id'])) {
        // Get the no_history from the URL
        $member_id = $_GET['member_id'];
        $no_history = $_GET['no_history'];
        $point_add = $_GET['point'];
        $event_id = $_GET['event_id'];

        $approve_datetime = date("Y-m-d h:i:s");
    
        $process = "UPDATE event_approve
        SET admin_id     = '".$_SESSION['nokp']."',
            admin_approve = '1',
            approve_datetime = '".$approve_datetime."'
        WHERE no_history = '".$no_history."'";
    
        $sql = "SELECT member_point FROM member WHERE member_nokp = $member_id ";
        $result = mysqli_query($combine_data, $sql);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $member_point = $row['member_point']; 
        }

        $member_point += $point_add;
        $process_add = "UPDATE member
        SET member_point = $member_point
        WHERE member_nokp = '".$member_id."'";

        // History

        $no = 0;

        $sql_no_join = "SELECT no_point_history FROM point_history WHERE member_id = '$member_id'";

        $no_join_generater = mysqli_query($combine_data, $sql_no_join);
        if($no_join_generater && mysqli_num_rows($no_join_generater) > 0){
            while ($row = mysqli_fetch_assoc($no_join_generater)) {
                $no ++;
            }
        }
        
        $no_point_history = $member_id . "|" . $no + 1;
        $datetime_history = date("Y-m-d h:i:s");

        $process_history = "INSERT INTO point_history (no_point_history, member_id, event_id, point_get,datetime_history)
        VALUES ('$no_point_history', '$member_id', '$event_id', '$point_add', '$datetime_history')";

        if(mysqli_query($combine_data, $process) && mysqli_query($combine_data, $process_add) && mysqli_query($combine_data, $process_history)) {
            echo "<script>alert('Approve Success.');
            window.location.href='admin_event_attendance.php';</script>";
        }
        else
        {
            echo "<script>alert('Error! Approve Not Success.');
            window.location.href='admin_event_attendance.php';</script>";
        }
    }else{
        echo "<script>alert('Error! Data Not Found.'); window.location.href='index.php';</script>";
    }

?>
