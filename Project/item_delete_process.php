<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['item_id']) && !empty($_GET['item_id'])){

        $item_id = mysqli_real_escape_string($combine_data, $_GET['item_id']);

        // Delete item
        $process = "DELETE FROM item
                    WHERE item_id = '$item_id'";

        if(mysqli_query($combine_data, $process)){
            // Success
            echo "<script>alert('Delete Item Success.'); window.location.href='admin_item_manage.php';</script>";
        }
        else {
            // Error
            echo "<script>alert('Error! Delete Item Not Success.'); window.location.href='admin_item_manage.php';</script>";
        }
    }
    else {
        echo "<script>alert('Error! Item ID not provided.'); window.location.href='admin_item_manage.php';</script>";
    }
?>
