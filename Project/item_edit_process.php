<?php
session_start();
include('admin_check.php');

if(empty($_POST)) {
    die("<script>alert('Error! Data Not Found.'); window.location.href='admin_account_details.php';</script>");
}

include('connection.php');

$_POST['point'] = $_POST['price'] * 100;

if ($_POST['id_new'] != $_GET['item_id']) {
    $check_data_query = "SELECT * FROM item WHERE item_id = '" . $_POST['id_new'] . "'";
    $check_data_result = mysqli_query($combine_data, $check_data_query);

    if (mysqli_num_rows($check_data_result) > 0) {
        echo "<script>alert('Item ID already registered.'); history.go(-1);</script>";
    } else {
        $process = "UPDATE item
                    SET item_id     = '".$_POST['id_new']."',
                        item_name   = '".$_POST['name']."',
                        item_price  = '".$_POST['price']."',
                        item_point  = '".$_POST['point']."'
                    WHERE item_id = '".$_GET['item_id']."'";

        if(mysqli_query($combine_data,$process)){
            echo "<script>alert('Edit success'); window.location.href='admin_item_manage.php';</script>";
        } else {
            echo "<script>alert('Error! Edit not success.'); window.location.href='admin_item_manage.php';</script>";
        }
    }
} else {
    $process = "UPDATE item
                SET item_id     = '".$_POST['id_new']."',
                    item_name   = '".$_POST['name']."',
                    item_price  = '".$_POST['price']."',
                    item_point  = '".$_POST['point']."'
                WHERE item_id = '".$_GET['item_id']."'";

    if(mysqli_query($combine_data,$process)){
        echo "<script>alert('Edit success'); window.location.href='admin_item_manage.php';</script>";
    } else {
        echo "<script>alert('Error! Edit not success.'); window.location.href='admin_item_manage.php';</script>";
    }
}
?>