<?php
include('connection.php');

$nokp = $_SESSION['nokp'];
$sql = "SELECT permission FROM admin WHERE admin_nokp = '$nokp'";
$result = mysqli_query($combine_data, $sql);

$result = mysqli_query($combine_data, $sql);
if($result && mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        $permission = $row['permission'];
    }
}

if($permission != 1){
    echo "<script>alert('Low in Permission.'); window.history.go(-1); die();</script>"; 
}
?>