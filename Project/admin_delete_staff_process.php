
<?php
    session_start();
    include('admin_check.php');
    include('connection.php');
    include('permission_check.php');

    if(isset($_GET['admin_id'])) {
        // Get the admin_id from the URL
        $admin_id = $_GET['admin_id'];

        $process = "DELETE FROM admin
                    WHERE admin_nokp = '$admin_id'";

        $file = 'UPLOAD/Admin/' . $admin_id . '.jpg'; 

        unlink($file);

        if(mysqli_query($combine_data,$process)){
            echo "<script>alert('Delete Account Success.'); window.location.href='admin_staff_manage.php';</script>";
        }
        else
        {
            echo "<script>alert('Error! Delete Account Not Success.'); window.location.href='admin_staff_manage.php';</script>";
        }
    }else{
        echo "<script>alert('Error! Data Not Found.'); window.location.href='index.php';</script>";
    }

?>