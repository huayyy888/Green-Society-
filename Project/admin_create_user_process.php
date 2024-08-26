<?php
    session_start();

    if(empty($_POST))
    {
        die("<script>alert('Error! Data Not Found.');
        window.location.href='index.php';</script>");
    }

    if ($_POST['memberPass'] != $_POST['memberCPass']) {
        die("<script>alert('Error! Wrong Password.');
        history.go(-1);</script>");
    }

    include('connection.php');

    $check_data_query = "SELECT * FROM member WHERE member_nokp = '" . $_POST['memberNokp'] . "'";
    $check_data_result = mysqli_query($combine_data, $check_data_query);

    if (mysqli_num_rows($check_data_result) > 0) {
        echo "<script>alert('NoKP already registered.');
        history.go(-1);</script>";
    } else {
        if (isset($_FILES['file']))
        { 
            $file = $_FILES['file'];
            
            if ($file['error'] > 0)
            {
                // Check the error code.
                switch ($file['error'])
                {
                    case UPLOAD_ERR_NO_FILE: // Code = 4.
                        copy("UPLOAD/Member/no_user_picture.png","UPLOAD/Member/". $_POST['memberNokp'] .".jpg");
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
                    $save_as = $_POST['memberNokp'].'.jpg'; // new filename
                    
                    move_uploaded_file($file['tmp_name'], 'UPLOAD/Member/' . $save_as);
                }
            }
            
            if (isset($err))
            {
                echo "<script>alert('$err');
                history.go(-1);</script>";
            }
            else
            {
                $process = "INSERT INTO member (member_nokp, member_name, member_password, member_phone, member_email, member_address)
                VALUES ('" . $_POST['memberNokp'] . "','" . $_POST['memberName'] . "','" . $_POST['memberPass'] . "','" . $_POST['memberPhone'] . "','" . $_POST['memberEmail'] . "','" . $_POST['memberAddress'] . "')";

                if (mysqli_query($combine_data, $process)) {
                    echo "<script>alert('Register Success'); window.location.href='admin_user_manage.php';</script>";
                } else {
                    echo "<script>alert('Error! Register not success.');
                    history.go(-1);</script>";
                }
            }
        }
    }

?>