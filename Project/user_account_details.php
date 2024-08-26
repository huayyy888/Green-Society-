<?php
    session_start();
    include('user_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/user_account_details.css">
    <style>
        /* Style for body */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    height:100%;
}

.body_loaction {
    max-width: 600px;
    margin: 90px auto;
    padding: 60px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container{
    background-image: url("PIC/member_login_background.jpg");
    background-repeat: no-repeat;
    background-size:100%;
}

.user_picture img {
    margin-top:35px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #28a745; /* Green border */
}


.user_details {
    margin-top: 20px;
}

.user_details h3 {
    margin-bottom: 10px;
    color: #333;
}

.user_details p {
    margin: 0;
    color: #666;
}

.user_details a {
    color: black; /* Green color */
    text-decoration: none;
}

.user_details a:hover {
    text-decoration: underline;
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
<div class="container">
    <div class="body_loaction">
        
        <!-- User Information -->
        <div class="user_details_location">
            <!-- Show User Picture -->
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

            <!-- User Details -->
            <div class="user_details">
                <?php
                    echo "
                    <h3><u>Account Details</u></h3>
                    <p>
                        ID : <a>$id</a>

                        <br>

                        Name : <a>$name</a>

                        <br>

                        Phone : <a>$phone</a>

                        <br>

                        Email : <a>$email</a>

                        <br>

                        <h3><u>User Address</u></h3>

                        <p class='user_address'>$address</p>
                    </p>
                    ";
                ?>
            </div>
        </div>

        <br>

        <!-- Edit Details -->
        <button class="button" onclick="location.href='upload_user_picture.php';" title="Click to upload picture"><i class="fa-solid fa-image"></i> Upload Picture</button>

        <button class="button" onclick="location.href='edit_user_details.php';" title="Click to Edit Details!"><i class="fa-solid fa-pen-to-square"></i> Edit Details</button>

        <!-- Delete Account -->
        <button class="button" onclick="if(confirm('Click OK to delete this account.')) { location.href='user_delete_self.php'; }" title="Click to Delete This Account!"><i class="fa-solid fa-trash-can"></i> Delete This Account</button>
        </div>
    </div>
</body>



<?php
    include('footer.php');
?>
