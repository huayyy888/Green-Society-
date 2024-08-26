<?php
    session_start();
    include('connection.php');

    $process = "DELETE FROM temp_add_item_e003";

    if(mysqli_query($combine_data,$process)){
        echo "<script>alert('Delete Table Data Success.'); history.go(-1);</script>";
    }
    else
    {
        echo "<script>alert('Error! Delete Table Data Not Success.'); history.go(-1);</script>";
    }

?>