<?php
    session_start();
    include('user_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/upload_user_picture.css">
    <style>
        /* Body styles */
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

.user_picture img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    
}

.user_upload_picture_form{
    margin-left:10px;
    margin-top:auto;
    margin-bottom:auto;
    height: 60px;
    width: 500px;
    border-radius: 10px;
}

.user_upload_picture_form label {
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

#user_picture{
    margin-top: 10px;
}

        </style>
</head>

<!-- Read Data -->
<?php
    $nokp = $_SESSION['nokp'];
    $sql = "SELECT * FROM member
            WHERE member_nokp = '$nokp'";

    $result = mysqli_query($combine_data, $sql);
    if($result && mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        $id = $row['member_nokp'];
        $name = $row['member_name'];
        $phone = $row['member_phone'];
        $email = $row['member_email'];
        $address = $row['member_address'];
        $point = $row['member_point'];
        $picture = 'UPLOAD/Member/' . $id . '.jpg';
    } 
?>

<body>
    <div class="body_loaction">

        <button class="button" onclick="location.href='user_account_details.php';" title="Back to account details"><i class="fa-solid fa-circle-left"></i> Back</button>

        <br><br>

        <h2><u>Upload New Picture</u></h2>

        <!-- Show User Picture -->
        <div class="flex">
        <div class="user_picture">
            <?php
                if(isset($picture) && file_exists($picture)) {
                    $cacheBuster = time();
                    $pictureUrl = "$picture?t=$cacheBuster";
                    echo "<img src='$pictureUrl' id='picture_user' alt='User Picture' />";
                } else {
                    echo "<img src='UPLOAD/Member/no_user_picture.png' id='picture_user' alt='User Picture' />";
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
                        
                        move_uploaded_file($file['tmp_name'], 'UPLOAD/Member/' . $save_as);

                        echo "<script>alert('Success Upload.')</script>";

                        echo "<script>window.location.href = 'user_account_details.php';</script>";
                    }
                }
                
                if (isset($err))
                {
                    echo "<script>alert('$err')</script>";
                }
            }
        ?>

        <!-- Picture Upload Form -->
        <div class="user_upload_picture_form">
            <form onsubmit="return confirm('Confirm want to upload the picture?');" action="" method="post" enctype="multipart/form-data">
                <label for="user_picture">Upload User Picture (Only JPG, PNG and WEBP are allowed.)</label>
                <div class="upload_picture_location">
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input id="user_picture" type="file" name="file" id="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
                    </div>
                    <button class="button sub_btn" type="submit"><i class="fa-solid fa-image"></i> Upload</button>
                </div>
            </form>
        </div> 
        </div>   
    
    
    </div>
</body>

<?php
    include('footer.php');
?>
