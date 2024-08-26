<?php
session_start();
include('admin_check.php');

if(empty($_POST)) {
    die("<script>alert('Error! Data Not Found.'); window.location.href='admin_account_details.php';</script>");
}

include('connection.php');

if ($_POST['id_new'] != $_SESSION['nokp']) {
    $check_data_query = "SELECT * FROM admin WHERE admin_nokp = '" . $_POST['id_new'] . "'";
    $check_data_result = mysqli_query($combine_data, $check_data_query);

    if (mysqli_num_rows($check_data_result) > 0) {
        echo "<script>alert('NoKP already registered.'); history.go(-1);</script>";
    } else {
        $process = "UPDATE admin
                    SET admin_nokp     = '".$_POST['id_new']."',
                        admin_name     = '".$_POST['name']."',
                        admin_email    = '".$_POST['email']."'
                    WHERE admin_nokp = '".$_SESSION['nokp']."'";

        rename("UPLOAD/Admin/" . $_SESSION['nokp'] . ".jpg", "UPLOAD/Admin/" . $_POST['id_new'] . ".jpg");

        if(mysqli_query($combine_data,$process)){
            echo "<script>alert('Edit success'); window.location.href='admin_account_details.php';</script>";
            $_SESSION['nokp'] = $_POST['id_new'];
        } else {
            echo "<script>alert('Error! Edit not success.'); window.location.href='admin_account_details.php';</script>";
        }
    }
} else {
    $process = "UPDATE admin
                SET admin_nokp     = '".$_POST['id_new']."',
                    admin_name     = '".$_POST['name']."',
                    admin_email    = '".$_POST['email']."'
                WHERE admin_nokp = '".$_SESSION['nokp']."'";

    rename("UPLOAD/Admin/" . $_SESSION['nokp'] . ".jpg", "UPLOAD/Admin/" . $_POST['id_new'] . ".jpg");

    if(mysqli_query($combine_data,$process)){
        echo "<script>alert('Edit success'); window.location.href='admin_account_details.php';</script>";
        $_SESSION['nokp'] = $_POST['id_new'];
    } else {
        echo "<script>alert('Error! Edit not success.'); window.location.href='admin_account_details.php';</script>";
    }
}
?>