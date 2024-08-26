<?php
    session_start();
    include('admin_check.php');
    include('permission_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_account_details.css">

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

.admin_picture img {
    margin-top:35px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #28a745; /* Green border */
}


.admin_details {
    margin-top: auto;
    margin-bottom : auto;
    margin-left: 10px;
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

.admin_details_location{
    display: flex;
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
    if(isset($_GET['admin_id'])) {
        // Get the admin_id from the URL
        $admin_id = $_GET['admin_id'];

        // Fetch admin details based on admin_id
        $sql = "SELECT * FROM admin WHERE admin_nokp = '$admin_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch admin details
            $row = mysqli_fetch_assoc($result);
            $id = $row['admin_nokp'];
            $name = $row['admin_name'];
            $email = $row['admin_email'];
            $password = $row['admin_password'];
            $picture = 'UPLOAD/Admin/' . $id . '.jpg';
        }
    } else {
        echo "<p>No Staff ID provided.</p>";
        echo "<script>location.href='admin_staff_manage.php'</script>";
    }
?>

<body>
    <div class="body_loaction">

    <button class="button" onclick="location.href='admin_staff_manage.php';" title="Back to Staff Management"><i class="fa-solid fa-circle-left"></i> Back</button>

    <br><br>

    <div class="flex">
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
                    <h3><u>Account Details</u></h3>
                    <p>
                        ID : <a>$id</a>

                        <br>

                        Name : <a>$name</a>

                        <br>

                        Email : <a>$email</a>

                        <br>

                        Password : <a>$password</a>

                        <br>
                    </p>
                    ";
                ?>
            </div>
        </div>
        </div>
        <br>

        <!-- Edit Details -->
        <button class="button" onclick="location.href='admin_edit_staff_details.php?admin_id=<?php echo $id; ?>'" title="Click to Edit Details!"><i class="fa-solid fa-pen-to-square"></i> Edit Details</button>

        <!-- Delete Account -->
        <button class="button" onclick="if(confirm('Click OK to delete this account.')) { location.href='admin_delete_staff_process.php?admin_id=<?php echo $id; ?>'; }" title="Click to Delete This Account!"><i class="fa-solid fa-trash-can"></i> Delete This Account</button>
    </div>
</body>

<?php
    include('footer.php');
?>
