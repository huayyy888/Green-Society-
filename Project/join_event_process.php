<?php
    session_start();
    include('user_check.php');
    include('connection.php');

    if(isset($_GET['event_id']) && isset($_GET['type'])){
        // Fetch user details based on member_id
        $event_id = $_GET['event_id'];

        $sql = "SELECT * FROM event WHERE event_id = '$event_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $id = $row['event_id'];
            $name = $row['event_name'];
            $type = $row['event_join_type'];
            $description = $row['event_description'];
            $location = $row['event_location'];
            $date = $row['event_date'];

            $join_datetime = date("Y-m-d h:i:s");

            $no = 0;

            $nokp = $_SESSION['nokp'];

            $sql_no_join = "SELECT no_join FROM event_join WHERE event_id = '$id'";

            $no_join_generater = mysqli_query($combine_data, $sql_no_join);
            if($no_join_generater && mysqli_num_rows($no_join_generater) > 0){
                while ($row = mysqli_fetch_assoc($no_join_generater)) {
                    $no ++;
                }
            }

            if($no != 0){
                $sql_member_join_no = "SELECT no_join FROM event_join WHERE event_id = '$id' AND member_nokp = '$nokp'";
                $check_member_join = mysqli_query($combine_data, $sql_member_join_no);
                if($check_member_join && mysqli_num_rows($check_member_join) > 0){
                    echo "<script>alert('Already join event.'); window.location.href='event_list.php';</script>";
                    exit();
                }
            }

            $no_join = $id . "|" . $no + 1;
            $file_join = $id . "=" . $nokp;
        }

        if($type == "3"){
            echo "<script>history.go(-1);</script>";
        }

        if($type == "1"){
            $process = "INSERT INTO event_join (no_join, member_nokp, event_id, datetime_join)
            VALUES ('$no_join', '" . $_SESSION['nokp'] . "', '$event_id', '$join_datetime')";

            if (mysqli_query($combine_data, $process)) {
                echo "<script>alert('Success Join Event.'); window.location.href='event_list.php';</script>";
            } else {
                echo "<script>alert('Error to join event.');
                history.go(-1);</script>";
            }
        }

        // User Upload Picture or ...
        if($type == "2"){
            $file = $_FILES['file'];

            if ($file['error'] > 0)
                {
                    // Check the error code.
                    switch ($file['error'])
                    {
                        case UPLOAD_ERR_NO_FILE: // Code = 4.
                            $err = 'No file was selected.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE: // Code = 2.
                            $err = 'File uploaded is too large. Maximum 1MB allowed.';
                            break;
                        default: // Other codes.
                            $err = 'There was an error while uploading the file.';
                            break;
                    }
                }
                else if ($file['size'] > 2097152) 
                {
                    // Check the file size. Prevent hacks.
                    // 2MB = 2097152.
                    $err = 'File uploaded is too large. Maximum 2MB allowed.';
                }
                else // proceed to check file type
                {
                    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    
                    if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png')
                    {
                        $err = 'Only JPG and PNG format are allowed.';
                    }
                    else // everything ok, proceed to move the file
                    {
                        $save_as = $file_join.'.jpg'; // new filename
                        
                        move_uploaded_file($file['tmp_name'], 'UPLOAD/Event/' . $save_as);

                        $process = "INSERT INTO event_join (no_join, member_nokp, event_id, datetime_join)
                        VALUES ('$no_join', '" . $_SESSION['nokp'] . "', '$event_id', '$join_datetime')";

                        if (mysqli_query($combine_data, $process)) {
                            echo "<script>alert('Success Join Event.'); window.location.href='event_list.php';</script>";
                        } else {
                            echo "<script>alert('Error to join event.');
                            history.go(-1);</script>";
                        }
                    }
                }
                
                if (isset($err))
                {
                    echo "<script>alert('$err');
                    history.go(-1);</script>";
                }
            
        }

        
    }else{
        echo "<script>history.go(-1);</script>";
    }
?>