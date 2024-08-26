<?php
    session_start();
    include('admin_check.php');
    include('connection.php');

    if(empty($_POST)) {
        die("<script>alert('Error! Data Not Found.');
        window.location.href='index.php';</script>");
    }

    // Reset Cookie
    $cookie_name = "admin_edit_user_details_process";
    setcookie($cookie_name, "0", time() + (86400 * 30), "/"); // 86400 = 1 day

    // See have repeat or not
    if ($_POST['id_new'] != $_GET['event_id']){
        $check_data_query = "SELECT * FROM event WHERE event_id = '" . $_POST['id_new'] . "'";
        $check_data_result = mysqli_query($combine_data, $check_data_query);

        if (mysqli_num_rows($check_data_result) > 0) {
            echo "<script>alert('ID already registered.');
            history.go(-1);</script>";
        }else {
            // Set Cookie as 1
            setcookie($cookie_name, "1", time() + (86400 * 30), "/"); // 86400 = 1 day
        }
    }else{
        setcookie($cookie_name, "1", time() + (86400 * 30), "/"); // 86400 = 1 day
    }

    // See got file upload or not
    if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == "1") {

        $process = "UPDATE event
        SET event_id     = '".$_POST['id_new']."',
            event_name     = '".$_POST['name']."',
            event_type    = '".$_POST['type_select']."',
            event_date    = '".$_POST['date']."',
            event_location  = '".$_POST['location']."',
            event_description  = '".$_POST['description']."',
            event_join_type = '".$_POST['join_type']."'
        WHERE
        event_id = '".$_GET['event_id']."'";

        if(mysqli_query($combine_data,$process)){
            echo "<script>alert('Edit success');
            window.location.href='admin_event_manage.php?event_id=" . $_POST['id_new'] . "';</script>";
        }
        else
        {
            echo "<script>alert('Error! Edit not success.');
            window.location.href='admin_event_manage.php?event_id==" . $_GET['event_id'] . "';</script>";
        }
    }
    

?>