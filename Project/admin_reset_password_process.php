<?php
    session_start();
    include('admin_check.php');


if(empty($_POST))
{
    die("<script>alert('Error! Data Not Found.');
    window.location.href='admin_account_details.php';</script>");
}

include('connection.php');

$nokp = $_SESSION['nokp'];
$sql = "SELECT * FROM admin
        WHERE admin_nokp = '$nokp'";

$result = mysqli_query($combine_data, $sql);
if($result && mysqli_num_rows($result)){
    $row = mysqli_fetch_assoc($result);
    $id = $row['admin_nokp'];
    $password = $row['admin_password'];
    $picture = 'UPLOAD/Admin/' . $id . '.jpg';
} 

if($_POST['CurrentPass'] != $password){
    die("<script>alert('Error! Wrong Password.');
    window.location.href='admin_reset_password.php';</script>");
}

if($_POST['NewPass'] != $_POST['ConfirmPass']){
    die("<script>alert('Error! Wrong Password.');
    window.location.href='admin_reset_password.php';</script>");
}

$process = "UPDATE admin
SET admin_password     = '".$_POST['ConfirmPass']."'
WHERE admin_nokp = '".$_SESSION['nokp']."'";

if(mysqli_query($combine_data,$process)){
    echo "<script>alert('Reset Password Success.');
    window.location.href='admin_account_details.php';</script>";
}
else
{
    echo "<script>alert('Error! Reset Password Not Success.');
    history.go(-1);</script>";
}

?>