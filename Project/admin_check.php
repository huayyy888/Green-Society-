<?php
if(empty($_SESSION['account_type']) or $_SESSION['account_type'] != "admin"){
    echo "<script>alert('Not yet login.')</script>";

    echo "<script>window.location.href = 'admin_login.php'</script>";
}
?>