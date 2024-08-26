<?php
if(empty($_SESSION['account_type']) or $_SESSION['account_type'] != "user"){
    echo "<script>alert('Not yet login.')</script>";

    echo "<script>window.location.href = 'user_login.php'</script>";
}
?>