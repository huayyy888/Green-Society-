

<?php
    session_start();
    include('user_check.php');
    include('connection.php');

    $nokp = $_SESSION['nokp'];
    $process = "DELETE FROM member
                WHERE member_nokp = '$nokp'";

    $file = 'UPLOAD/Member/' . $nokp . '.jpg'; 

    unlink($file);

    if(mysqli_query($combine_data,$process)){
        echo "<script>alert('Delete Account Success.'); window.location.href='logout.php';</script>";
    }
    else
    {
        echo "<script>alert('Error! Delete Account Not Success.'); window.location.href='user_account_details.php';</script>";
    }

?>