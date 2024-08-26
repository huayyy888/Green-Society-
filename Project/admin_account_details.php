<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_account_details.css">

    <style>
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

.admin_details_location{
    display: flex;
}

.admin_picture img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #28a745; /* Green border */
}


.admin_details {
    padding-left: 10px;
}

.admin_details h3 {
    margin-bottom: 10px;
    color: #333;
}

.admin_details p {
    margin: 0;
    color: #666;
}

.admin_details a {
    color: black; /* Green color */
    text-decoration: none;
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


        <!-- User Information -->
        <div class="admin_details_location">
            <!-- Show User Picture -->
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

            <!-- User Details -->
            <div class="admin_details">
                <?php
                    echo "
                    <br>
                    <h3><u>Account Details</u></h3>
                    <p>
                        Admin ID : <a>$id</a>

                        <br>

                        Name : <a>$name</a>

                        <br>

                        Email : <a>$email</a>

                        <br>

                    </p>
                    ";
                ?>
            </div>
        </div>
        

        



        <br>

        <!-- Edit Details -->
        <button class="button" onclick="location.href='upload_admin_picture.php';" title="Click to upload picture"><i class="fa-solid fa-image"></i> Upload Picture</button>

        <button class="button" onclick="location.href='edit_admin_details.php';" title="Click to Edit Details!"><i class="fa-solid fa-pen-to-square"></i> Edit Details</button>

    </div>
</body>



<?php
    include('footer.php');
?>
