<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <style>

        #picture_gift{
            max-width : 300px;
            padding: 10px;
            border: 1px solid black;
        }

    </style>
</head>

<!-- Read Data -->
<?php
    if(isset($_GET['gift_id'])) {
        // Get the gift_id from the URL
        $gift_id = $_GET['gift_id'];

        // Fetch user details based on gift_id
        $sql = "SELECT * FROM gift WHERE gift_id = '$gift_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $id = $row['gift_id'];
            $name = $row['gift_name'];
            $stock = $row['gift_stock'];
            $point = $row['gift_point'];
            $description = $row['description'];
            $picture = 'UPLOAD/Gift/' . $id . '.jpg';
            if(isset($picture) && file_exists($picture)) {
                $pictureUrl = "<img src='$picture' id='picture_gift' alt='Gift Picture' />";
            } else {
                $pictureUrl =  "<img src='UPLOAD/Gift/no_gift_picture.png' id='picture_gift' alt='Gift Picture' />";
            }
        }
    } else {
        echo "<p>No gift ID provided.</p>";
        echo "<script>location.href='gift_menu.php'</script>";
    }
?>

<body>
    <div class="body_loaction">

    <button onclick="location.href='gift_menu.php'" title="Back to Item Check"><i class="fa-solid fa-circle-left"></i> Back</button>

    <br>
    <h2><u>Edit Item Details</u></h2>

        <!-- User Information -->
        <script>
            function resetValue(input_name, originalValue) {
                document.getElementById(input_name).value = originalValue;
            }
        </script>     


        <form class="form_admin_edit_user" action='gift_edit_process.php?gift_id=<?php echo $id ?>' method='POST' enctype="multipart/form-data">
            
            <?php echo $pictureUrl ?>
        
            <div class="gift_upload_picture_form">
                <label for="gift_picture">Upload Picture (Only JPG, PNG and WEBP are allowed.)<br> You also can upload picture later</label>
                <br>
                <div class="upload_picture_location">
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input id="user_picture" type="file" name="file" id="file" accept="image/jpeg, image/png, image/webp" onchange="updateText()"/>
                    </div>
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

            <label for="point">Point Need : </label>
            <input type='number' min="1" max="999" name='point' id='point' value='<?php echo $point ?>' required>
            <button type="button" onclick="resetValue('point', '<?php echo $point ?>')"><i class="fa-solid fa-rotate"></i></button>


            <br><br>

            <label for="stock">Stock : </label>
            <input type='number' min="0.01" max="999.99" name='stock' id='stock'  step="0.01" value='<?php echo $stock ?>' required>
            <button type="button" onclick="resetValue('stock', '<?php echo $stock ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="description" class="description_label">Description : </label>
            <textarea maxlength='200' name='description' id='description' rows='10' cols='60' style='max-width: 616px;' required><?php echo $description ?></textarea>
            <button type="button" onclick="resetValue('description', '<?php echo $description ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>
            
            <button type="submit">Submit</button>
            <button type="button" onclick="
                resetValue('stock', '<?php echo $stock ?>');
                resetValue('id_new', '<?php echo $id ?>');
                resetValue('name', '<?php echo $name ?>');
                resetValue('point', '<?php echo $point ?>');
                resetValue('description', '<?php echo $description ?>');
            ">Reset All</i></button>
        </form>

    </div>
        
    
</body>

<?php
    include('footer.php');
?>
