<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(isset($_GET['gift_id']) && !empty($_GET['gift_id'])){

        $gift_id = mysqli_real_escape_string($combine_data, $_GET['gift_id']);

        // Delete gift
        $process = "DELETE FROM gift
                    WHERE gift_id = '$gift_id'";

        if(mysqli_query($combine_data, $process)){
            // Success
            $delete = $gift_id.'.jpg'; 

            unlink('UPLOAD/Gift/' . $delete);

            echo "<script>alert('Delete Item Success.'); window.location.href='gift_edit_menu.php';</script>";
        }
        else {
            // Error
            echo "<script>alert('Error! Delete Item Not Success.'); window.location.href='gift_edit_menu.php';</script>";
        }
    }
    else {
        echo "<script>alert('Error! Item ID not provided.'); window.location.href='gift_edit_menu.php';</script>";
    }
?>
