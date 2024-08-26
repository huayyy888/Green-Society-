<?php
include('connection.php');
session_start();

if(isset($_GET['total']) && isset($_GET['member_id'])) {
    $totalpoint = $_GET['total'];
    $member_id = $_GET['member_id'];
    $num = 0;

    // Count the number of events for this member
    $data_number_event_sql = "SELECT * FROM event_approve WHERE member_id = $member_id";
    $result_number = mysqli_query($combine_data, $data_number_event_sql);
    $num = mysqli_num_rows($result_number);

    // Check if file is uploaded
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        if ($file['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            // Check file extension
            if ($ext === 'pdf') {
                $num++;
                $save_as = $member_id . '=E003=' . $num . '.pdf'; // New filename
                $upload_dir = 'UPLOAD/Event/PDF/';

                // Move the file to the upload directory
                if (move_uploaded_file($file['tmp_name'], $upload_dir . $save_as)) {
                    // Insert event history into the database
                    $no_history = $member_id . '=E003=' . $num;
                    $process = "INSERT INTO event_approve (no_history, member_id, event_id, point_added, register_datetime, admin_id, admin_approve, approve_datetime)
                    VALUES ('$no_history', '$member_id', 'E003', '$totalpoint', NOW(), '', '', '')";

                    if (mysqli_query($combine_data, $process)) {
                        echo "<script>alert('Success Add to Approve.'); window.location.href='admin_event_attendance.php';</script>";
                        include('E003_delete_all_data.php');
                    } else {
                        echo "<script>alert('Error! Join event not successful.'); history.go(-1);</script>";
                    }
                } else {
                    $err = 'Failed to move the uploaded file.';
                }
            } else {
                $err = 'Only PDF files are allowed.';
            }
        } else {
            // Error occurred during file upload
            $err = 'Error occurred during file upload.';

            // Handle specific errors
            switch ($file['error']) {
                case UPLOAD_ERR_NO_FILE:
                    $err = 'No file uploaded.';
                    break;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $err = 'File uploaded is too large. Maximum 1MB allowed.';
                    break;
            }
        }

        // Display error message if any
        if (isset($err)) {
            echo "<script>alert('$err'); history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('Error! No file uploaded.'); history.go(-1);</script>";
    }
} else {
    echo "<script>alert('Error! Data Not Found.'); history.go(-1);</script>";
}
?>
