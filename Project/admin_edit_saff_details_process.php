<?php
    session_start();
    include('admin_check.php');
    include('permission_check.php');
    include('connection.php');

    if(empty($_POST)) {
        die("<script>alert('Error! Data Not Found.');
        window.location.href='index.php';</script>");
    }

    // Reset Cookie
    $cookie_name = "admin_edit_admin_details_process";
    setcookie($cookie_name, "0", time() + (86400 * 30), "/"); // 86400 = 1 day

    // See have repeat or not
    if ($_POST['id_new'] != $_GET['admin_id']){
        $check_data_query = "SELECT * FROM admin WHERE admin_nokp = '" . $_POST['id_new'] . "'";
        $check_data_result = mysqli_query($combine_data, $check_data_query);

        if (mysqli_num_rows($check_data_result) > 0) {
            echo "<script>alert('NoKP already registered.');
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
        if (isset($_FILES['file']))
        { 
            $file = $_FILES['file'];
            
            if ($file['error'] > 0)
            {
                // Check the error code.
                switch ($file['error'])
                {
                    case UPLOAD_ERR_NO_FILE: // Code = 4.
                        break;
                    case UPLOAD_ERR_FORM_SIZE: // Code = 2.
                        $err = 'File uploaded is too large. Maximum 1MB allowed.';
                        break;
                    default: // Other codes.
                        $err = 'There was an error while uploading the file.';
                        break;
                }
            }
            else if ($file['size'] > 1048576) 
            {
                // Check the file size. Prevent hacks.
                // 1MB = 1024KB = 1048576B.
                $err = 'File uploaded is too large. Maximum 1MB allowed.';
            }
            else // proceed to check file type
            {

                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                
                if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'webp')
                {
                    $err = 'Only JPG, PNG and WEBP format are allowed.';
                }
                else // everything ok, proceed to move the file
                {

                    $save_as = $_GET['admin_id'].'.jpg'; // new filename
                    
                    move_uploaded_file($file['tmp_name'], 'UPLOAD/Admin/' . $save_as);
                }
            }
            
            
        }

        if (isset($err))
            {
                echo "<script>alert('$err');
                history.go(-1);</script>";
            }
            else
            {
                $process = "UPDATE admin
                SET admin_nokp     = '".$_POST['id_new']."',
                    admin_name     = '".$_POST['name']."',
                    admin_email    = '".$_POST['email']."'
                WHERE
                admin_nokp = '".$_GET['admin_id']."'";

                rename("UPLOAD/Admin/". $_GET['admin_id'] . ".jpg","UPLOAD/Admin/". $_POST['id_new'] . ".jpg");

                if(mysqli_query($combine_data,$process)){
                    echo "<script>alert('Edit success');
                    window.location.href='admin_view_staff.php?admin_id=" . $_POST['id_new'] . "';</script>";
                }
                else
                {
                    echo "<script>alert('Error! Edit not success.');
                    window.location.href='admin_view_staff.php?admin_id==" . $_GET['admin_id'] . "';</script>";
                }
            }
    }
    

?>