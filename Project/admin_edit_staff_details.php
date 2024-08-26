<?php
    session_start();
    include('admin_check.php');
    include('permission_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_edit_staff_details.css">
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

    <button onclick="location.href='admin_view_staff.php?admin_id=<?php echo $id; ?>'" title="Back to Member Check"><i class="fa-solid fa-circle-left"></i> Back</button>

    <br>
    <h2><u>Edit Staff Details</u></h2>

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
        
            <br>

            <script>
                    function resetValue(input_name, originalValue) {
                        document.getElementById(input_name).value = originalValue;
                    }
                </script>     


            <form class="form_admin_edit_admin" action='admin_edit_saff_details_process.php?admin_id=<?php echo $id ?>' method='POST' enctype="multipart/form-data">

                <br>

                <div class="admin_upload_picture_form">
                    <label for="admin_picture">Upload Picture (Only JPG, PNG and WEBP are allowed.)<br> You also can upload picture later</label>
                    <br>
                    <div class="upload_picture_location">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input id="admin_picture" type="file" name="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
                    </div>
                </div>

                <p>Original ID : <b><?php echo $id ?></b></p>   

                <label for="id_new">ID : </label>
                <input type='text' maxlength='12' name='id_new' id='id_new' value='<?php echo $id ?>' required>
                <button type="button" onclick="resetValue('id_new', '<?php echo $id ?>')"><i class="fa-solid fa-rotate"></i></button>

                <br><br>

                <label for="name">Name : </label>
                <input type='text' maxlength='60' name='name' id='name' value='<?php echo $name ?>' required>
                <button type="button" onclick="resetValue('name', '<?php echo $name ?>')"><i class="fa-solid fa-rotate"></i></button>

                <br><br>
                
                <label for="email">Email : </label>
                <input type='email' maxlength='50' name='email' id='email' value='<?php echo $email ?>' required>
                <button type="button" onclick="resetValue('email', '<?php echo $email ?>')"><i class="fa-solid fa-rotate"></i></button>
                
                <br><br>
                
                <button type="submit">Submit</button>
                <button type="button" onclick="
                    resetValue('id_new', '<?php echo $id ?>');
                    resetValue('name', '<?php echo $name ?>');
                    resetValue('email', '<?php echo $email ?>');
                ">Reset All</i></button>
            </form>
        </div>
    </div>
</body>

<?php
    include('footer.php');
?>
