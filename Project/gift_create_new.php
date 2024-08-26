<?php
    session_start();
    include('header.php');
    include('connection.php');
    include('admin_check.php');
?>

<head>
    <link rel="stylesheet" href="CSS/register_new_user.css">
</head>

<div class="body_location">
    <button onclick="location.href='gift_menu.php';" title="Back to Gift Management"><i class="fa-solid fa-circle-left"></i> Back</button>

    <form action="gift_create_new_process.php" method="post" enctype="multipart/form-data">
    
        <h1>Add New Item</h1>

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

        <br>
        
        <label for="giftID">Item ID :</label>
            
        <input type="text" name="giftID" id="giftID" value="" required>

        <br><br>

        <label for="giftName">Name : </label>
        <input type="text" name="giftName" id="giftName" value="" required>

        <br><br>

        <label for="giftPoint">Point : </label>
        <input type="number" max="999" min="1" name="giftPoint" id="giftPoint" value="" required>

        <br><br>

        <label for="giftStock">Stock : </label>
        <input type="number" max="999" min="1" name="giftStock" id="giftStock" value="" required>

        <br><br>

        <label for="giftDescription">Description : </label>
        <textarea maxlength='200' name='giftDescription' id='giftDescription' rows='10' cols='60' style='max-width: 616px;' required></textarea>
        <br><br>

        <input type="submit" value="Add" name="Add">
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

    </form>

</div>

<?php
    include('footer.php');
?>