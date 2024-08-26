<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_edit_user_details.css">
</head>

<!-- Read Data -->
<?php
    if(isset($_GET['member_id'])) {
        // Get the member_id from the URL
        $member_id = $_GET['member_id'];

        // Fetch user details based on member_id
        $sql = "SELECT * FROM member WHERE member_nokp = '$member_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $id = $row['member_nokp'];
            $name = $row['member_name'];
            $phone = $row['member_phone'];
            $email = $row['member_email'];
            $address = $row['member_address'];
            $point = $row['member_point'];
            $picture = 'UPLOAD/Member/' . $id . '.jpg';
        }
    } else {
        echo "<p>No member ID provided.</p>";
        echo "<script>location.href='admin_user_manage.php'</script>";
    }
?>

<body>
    <div class="body_loaction">

    <button onclick="location.href='admin_view_user.php?member_id=<?php echo $id; ?>'" title="Back to Member Check"><i class="fa-solid fa-circle-left"></i> Back</button>

    <br>
    <h2><u>Edit Member Details</u></h2>

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
        
            <br>

            <script>
                    function resetValue(input_name, originalValue) {
                        document.getElementById(input_name).value = originalValue;
                    }
                </script>     


            <form class="form_admin_edit_user" action='admin_edit_user_details_process.php?member_id=<?php echo $id ?>' method='POST' enctype="multipart/form-data">

                <br>

                <div class="user_upload_picture_form">
                    <label for="user_picture">Upload Picture (Only JPG, PNG and WEBP are allowed.)<br> You also can upload picture later</label>
                    <br>
                    <div class="upload_picture_location">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input id="user_picture" type="file" name="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
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

                <label for="phone">Phone : </label>
                <input type='text' maxlength='11' name='phone' id='phone' value='<?php echo $phone ?>' required>
                <button type="button" onclick="resetValue('phone', '<?php echo $phone ?>')"><i class="fa-solid fa-rotate"></i></button>

                <br><br>
                
                <label for="email">Email : </label>
                <input type='email' maxlength='50' name='email' id='email' value='<?php echo $email ?>' required>
                <button type="button" onclick="resetValue('email', '<?php echo $email ?>')"><i class="fa-solid fa-rotate"></i></button>

                <br><br>

                <label for="point">Point : </label>
                <input type='number' min="0" name='point' id='point' value='<?php echo $point ?>' required>
                <button type="button" onclick="resetValue('point', '<?php echo $point ?>')"><i class="fa-solid fa-rotate"></i></button>

                <br><br>

                </div>

                <label for="address" class="address_label">Address : </label>
                <textarea maxlength='200' name='address' id='address' rows='10' cols='60' style='max-width: 616px;' required><?php echo $address ?></textarea>
                <button type="button" onclick="resetValue('address', '<?php echo $address ?>')"><i class="fa-solid fa-rotate"></i></button>

                <br><br>
                
                <button type="submit">Submit</button>
                <button type="button" onclick="
                    resetValue('address', '<?php echo $address ?>');
                    resetValue('id_new', '<?php echo $id ?>');
                    resetValue('name', '<?php echo $name ?>');
                    resetValue('phone', '<?php echo $phone ?>');
                    resetValue('email', '<?php echo $email ?>');
                    resetValue('address', '<?php echo $address ?>');
                    resetValue('point', '<?php echo $point ?>');
                ">Reset All</i></button>
            </form>
        
    </div>
</body>

<?php
    include('footer.php');
?>
