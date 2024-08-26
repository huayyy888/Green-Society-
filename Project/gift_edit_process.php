<?php
session_start();
include('admin_check.php');

if(empty($_POST)) {
    die("<script>alert('Error! Data Not Found.'); window.location.href='admin_account_details.php';</script>");
}

include('connection.php');

if ($_POST['id_new'] != $_GET['gift_id']) {
    $check_data_query = "SELECT * FROM gift WHERE gift_id = '" . $_POST['id_new'] . "'";
    $check_data_result = mysqli_query($combine_data, $check_data_query);

    if (mysqli_num_rows($check_data_result) > 0) {
        echo "<script>alert('Gift ID already registered.'); history.go(-1);</script>";
    } else {
        $process = "UPDATE gift
                    SET gift_id     = '".$_POST['id_new']."',
                        gift_name   = '".$_POST['name']."',
                        gift_stock  = '".$_POST['stock']."',
                        gift_point  = '".$_POST['point']."',
                        description = '".$_POST['description']."'
                    WHERE gift_id = '".$_GET['gift_id']."'";

        if (isset($_FILES['file']))
        { 
            $file = $_FILES['file'];
            
            if ($file['error'] > 0)
            {
                // Check the error code.
                switch ($file['error'])
                {
                    case UPLOAD_ERR_NO_FILE: // Code = 4.
                        rename("UPLOAD/Gift/" . $_GET['gift_id'] . ".jpg", "UPLOAD/Gift/" . $_POST['id_new'] . ".jpg");
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
                    $delete = $_GET['gift_id'].'.jpg'; 

                    unlink('UPLOAD/Gift/' . $delete);

                    $save_as = $_POST['id_new'].'.jpg'; // new filename
                    
                    move_uploaded_file($file['tmp_name'], 'UPLOAD/Gift/' . $save_as);
                }
            }
            
            if (isset($err))
            {
                echo "<script>alert('$err');
                history.go(-1);</script>";
            }
            else
            {
                if(mysqli_query($combine_data,$process)){
                    echo "<script>alert('Edit success'); window.location.href='gift_menu.php';</script>";
                } else {
                    echo "<script>alert('Error! Edit not success.'); window.location.href='gift_menu.php';</script>";
                }
            }
        }
    }
} else {
    $process = "UPDATE gift
                SET gift_id     = '".$_POST['id_new']."',
                    gift_name   = '".$_POST['name']."',
                    gift_stock  = '".$_POST['stock']."',
                    gift_point  = '".$_POST['point']."',
                    description = '".$_POST['description']."'
                WHERE gift_id = '".$_GET['gift_id']."'";

    if (isset($_FILES['file']))
        { 
            $file = $_FILES['file'];
            
            if ($file['error'] > 0)
            {
                // Check the error code.
                switch ($file['error'])
                {
                    case UPLOAD_ERR_NO_FILE: // Code = 4.
                        rename("UPLOAD/Gift/" . $_GET['gift_id'] . ".jpg", "UPLOAD/Gift/" . $_POST['id_new'] . ".jpg");
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
                    $delete = $_GET['gift_id'].'.jpg'; 

                    unlink('UPLOAD/Gift/' . $delete);

                    $save_as = $_POST['id_new'].'.jpg'; // new filename
                    
                    move_uploaded_file($file['tmp_name'], 'UPLOAD/Gift/' . $save_as);
                }
            }
            
            if (isset($err))
            {
                echo "<script>alert('$err');
                history.go(-1);</script>";
            }
            else
            {
                if(mysqli_query($combine_data,$process)){
                    echo "<script>alert('Edit success'); window.location.href='gift_menu.php';</script>";
                } else {
                    echo "<script>alert('Error! Edit not success.'); window.location.href='gift_menu.php';</script>";
                }
            }
        }
        
    if(mysqli_query($combine_data,$process)){
        echo "<script>alert('Edit success'); window.location.href='gift_menu.php';</script>";
    } else {
        echo "<script>alert('Error! Edit not success.'); window.location.href='gift_menu.php';</script>";
    }
}
?>