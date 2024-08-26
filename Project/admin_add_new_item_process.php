<?php
    session_start();

    if(empty($_POST))
    {
        die("<script>alert('Error! Data Not Found.');
        window.location.href='index.php';</script>");
    }

    include('connection.php');

    $_POST['itemPoint'] = $_POST['itemPrice'] * 100;

    $check_data_query = "SELECT * FROM item WHERE item_id = '" . $_POST['itemID'] . "'";
    $check_data_result = mysqli_query($combine_data, $check_data_query);

    if (mysqli_num_rows($check_data_result) > 0) {
        echo "<script>alert('Item ID already registered.');
        history.go(-1);</script>";
    } else {
        $process = "INSERT INTO item (item_id, item_name, item_price, item_point)
        VALUES ('" . $_POST['itemID'] . "','" . $_POST['itemName'] . "','" . $_POST['itemPrice'] . "','" . $_POST['itemPoint'] . "')";

        if (mysqli_query($combine_data, $process)) {
            echo "<script>alert('Success Adding Item.'); window.location.href='admin_item_manage.php';</script>";
        } else {
            echo "<script>alert('Error! Adding Item not success.');
            history.go(-1);</script>";
        }
    }

?>