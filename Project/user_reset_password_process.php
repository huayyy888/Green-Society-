<?php
    session_start();
    include('user_check.php');


if(empty($_POST))
{
    die("<script>alert('Error! Data Not Found.');
    window.location.href='user_account_details.php';</script>");
}

include('connection.php');

$nokp = $_SESSION['nokp'];
$sql = "SELECT * FROM member
        WHERE member_nokp = '$nokp'";

$result = mysqli_query($combine_data, $sql);
if($result && mysqli_num_rows($result)){
    $row = mysqli_fetch_assoc($result);
    $id = $row['member_nokp'];
    $password = $row['member_password'];
    $picture = 'UPLOAD/Member/' . $id . '.jpg';
} 

if($_POST['CurrentPass'] != $password){
    die("<script>alert('Error! Wrong Password.');
    window.location.href='user_reset_password.php';</script>");
}

if($_POST['NewPass'] != $_POST['ConfirmPass']){
    die("<script>alert('Error! Wrong Password.');
    window.location.href='user_reset_password.php';</script>");
}

$process = "UPDATE member
SET member_password     = '".$_POST['ConfirmPass']."'
WHERE member_nokp = '".$_SESSION['nokp']."'";

if(mysqli_query($combine_data,$process)){
    echo "<script>alert('Reset Password Success.');
    window.location.href='user_account_details.php';</script>";
}
else
{
    echo "<script>alert('Error! Reset Password Not Success.');
    window.location.href='user_reset_password.php';</script>";
}

?>