<?php
// name host
$name_host  =   "localhost";

// username for sql
$name_sql   =   "root";

// password for sql
$pass_sql   =   "";

// name to data
$name_data  =   "green_society";

// combine data to system
$combine_data   =   mysqli_connect($name_host, $name_sql, $pass_sql, $name_data);

date_default_timezone_set("Asia/Kuala_Lumpur");

// check if connection is success
if (!$combine_data) 
{
    // NO
    // die means no showing the below coding just showing No Connection
    die("No Connection");
}
else
{
    // YES
    // echo "Connected";
}
?>