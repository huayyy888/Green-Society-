<?php
    session_start();
    include('user_check.php');
    include('connection.php');

    if(isset($_GET['gift_id']) && isset($_GET['point'])) {
        // Get the no_history from the URL
        $gift_id = $_GET['gift_id'];
        $point = $_GET['point'];

        $member_id = $_SESSION['nokp'];

        $datetime = date("Y-m-d h:i:s");
        // History

        $no = 0;

        $sql_no_gift = "SELECT no_gift_history FROM gift_approve WHERE member_id = '$member_id'";

        $no_gift_generater = mysqli_query($combine_data, $sql_no_gift);
        if($no_gift_generater && mysqli_num_rows($no_gift_generater) > 0){
            while ($row = mysqli_fetch_assoc($no_gift_generater)) {
                $no ++;
            }
        }
    
        $sql = "SELECT gift_stock FROM gift WHERE gift_id = '$gift_id' ";
        $result = mysqli_query($combine_data, $sql);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $gift_stock = $row['gift_stock']; 
        }

        $gift_stock --;

        $process_add = "UPDATE gift
        SET gift_stock = $gift_stock
        WHERE gift_id = '".$gift_id."'";

        $no_gift_history = $member_id . "|" . $no + 1;

        $process_history = "INSERT INTO gift_approve (no_gift_history, member_id, gift_id, point,exchange_datetime, admin_id, approve, approve_datetime)
        VALUES ('$no_gift_history', '$member_id', '$gift_id', '$point', '$datetime','',0,'')";

        $sql_point = "SELECT member_point FROM member WHERE member_nokp = $member_id ";
        $result = mysqli_query($combine_data, $sql_point);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $member_point = $row['member_point']; 
        }

        $member_point -= $point;

        $num = 0;

        $sql_no_join = "SELECT no_point_history FROM point_history WHERE member_id = '$member_id'";

        $no_join_generater = mysqli_query($combine_data, $sql_no_join);
        if($no_join_generater && mysqli_num_rows($no_join_generater) > 0){
            while ($row = mysqli_fetch_assoc($no_join_generater)) {
                $num ++;
            }
        }

        $no_point_history = $member_id . "|" . $num + 1;

        $datetime_history = date("Y-m-d h:i:s");

        $process_point = "INSERT INTO point_history (no_point_history, member_id, event_id, point_get,datetime_history)
        VALUES ('$no_point_history', '$member_id', 'E005', '$point', '$datetime_history')";

        if($member_point >= 0){
            $process_add = "UPDATE member
            SET member_point = $member_point
            WHERE member_nokp = '".$member_id."'";

            if(mysqli_query($combine_data, $process_history) && mysqli_query($combine_data, $process_add) && mysqli_query($combine_data, $process_point)) {
                echo "<script>alert('Exchange Success.');
                window.location.href='user_gift_history.php';</script>";
            }
            else
            {
                echo "<script>alert('Error! Exchange Not Success.');
                history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('Point Not Enough.');
            history.go(-1);</script>";
        }
    }else{
        echo "<script>alert('Error! Data Not Found.'); window.location.href='index.php';</script>";
    }

?>
