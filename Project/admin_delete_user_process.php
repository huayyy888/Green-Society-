
<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['member_id'])) {
        // Get the member_id from the URL
        $member_id = $_GET['member_id'];

        $process = "DELETE FROM member
                    WHERE member_nokp = '$member_id'";

        $file = 'UPLOAD/Member/' . $member_id . '.jpg'; 

        unlink($file);

        if(mysqli_query($combine_data,$process)){
            echo "<script>alert('Delete Account Success.'); window.location.href='admin_user_manage.php';</script>";
        }
        else
        {
            echo "<script>alert('Error! Delete Account Not Success.'); window.location.href='admin_user_manage.php';</script>";
        }
    }else{
        echo "<script>alert('Error! Data Not Found.'); window.location.href='index.php';</script>";
    }

?>