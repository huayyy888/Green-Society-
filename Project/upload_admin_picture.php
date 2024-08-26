<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/upload_admin_picture.css">

    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

/* Container styles */
.body_loaction {
    width: 650px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Button styles */
button {
    padding: 10px 20px;
    background-color: #81a96f; 
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


h2 {
    color: #333;
    margin-top: 10px;
}

.admin_picture img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    
}

.admin_upload_picture_form{
    margin-left:10px;
    margin-top:auto;
    margin-bottom:auto;
    height: 60px;
    width: 500px;
    border-radius: 10px;
}

.admin_upload_picture_form label {
    display: block;
    margin-bottom: 5px;
}

.upload_picture_location {
    display: flex;
    align-items: center;
}

.upload_picture_location div {
    flex: 1;
}

.upload_picture_location button {
    margin-left: 10px;
}

.flex{
    display:flex;
}

.button {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #81a96f; /* Green color */
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.button:hover {
    background-color: #218838; /* Darker green color on hover */
}

.sub_btn{
    height : 30px;
    padding-top: 0;
    padding-bottom: 0;
}

#admin_picture{
    margin-top: 10px;
}

    </style>
</head>

<!-- Read Data -->
<?php
    $nokp = $_SESSION['nokp'];
    $sql = "SELECT * FROM admin
            WHERE admin_nokp = '$nokp'";

    $result = mysqli_query($combine_data, $sql);
    if($result && mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        $id = $row['admin_nokp'];
        $name = $row['admin_name'];
        $email = $row['admin_email'];
        $picture = 'UPLOAD/Admin/' . $id . '.jpg';
    } 
?>

<body>
    <div class="body_loaction">
    
        <button onclick="location.href='admin_account_details.php';" title="Back to account details"><i class="fa-solid fa-circle-left"></i> Back</button>

        <br>

        <h2><u>Upload New Picture</u></h2>
        <div class="flex">
        <!-- Show Admin Picture -->
        <div class="admin_picture">
            <?php
                if(isset($picture) && file_exists($picture)) {
                    $cacheBuster = time();
                    $pictureUrl = "$picture?t=$cacheBuster";
                    echo "<img src='$pictureUrl' id='picture_admin' alt='Admin Picture' />";
                } else {
                    echo "<img src='UPLOAD/Admin/no_admin_picture.png' id='picture_admin' alt='Admin Picture' />";
                }
            ?>
        </div>

        <!-- Picture Upload Process -->
        <?php
            if (isset($_FILES['file']))
            { 
                
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
                        $save_as = $id.'.jpg'; // new filename
                        
                        move_uploaded_file($file['tmp_name'], 'UPLOAD/Admin/' . $save_as);

                        echo "<script>alert('Success Upload.')</script>";

                        echo "<script>window.location.href = 'admin_account_details.php'</script>";
                    }
                }
                
                if (isset($err))
                {
                    echo "<script>alert('$err')</script>";
                }
            }
        ?>
            
        <br>

        <!-- Picture Upload Form -->
        <div class="admin_upload_picture_form">
            <form onsubmit="return confirm('Confirm want to upload the picture?');" action="" method="post" enctype="multipart/form-data">
                <label for="admin_picture">Upload Admin Picture (Only JPG, PNG and WEBP are allowed.)</label>
                <div class="upload_picture_location">
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input id="admin_picture" type="file" name="file" id="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
                    </div>
                    <button type="submit"><i class="fa-solid fa-image"></i> Upload</button>
                </div>
            </form>
        </div>    
    
        </div>
    </div>
</body>

<?php
    include('footer.php');
?>
