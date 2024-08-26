<?php
include ('connection.php');

session_start();

session_unset();

session_destroy();

$process = "DELETE FROM temp_add_item_e003";
mysqli_query($combine_data, $process);

echo"<script>
        window.location.href='index.php';
    </script>";
?>