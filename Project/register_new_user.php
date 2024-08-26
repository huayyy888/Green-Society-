<?php
    session_start();
    include('header.php');
    include('connection.php');
?>

<head>
    <style>
        /* Style for the body */
.body_location {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    background-color: #f0f0f0; /* Light gray background */
    background-image: url("PIC/background/background_1.jpg");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    opacity: 0.8;
    margin:0;
}

.address_label{
    float:left;
}

/* Style for the form container */
.body_location form {
    background-color: #fff; /* White background */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle effect */
    width: 600px;
    margin: 100px;
}

/* Style for the form elements */
.body_location h1 {
    text-align: center;
    margin-bottom: 20px;
    color: black; /* Green color for the heading */
}

.body_location label {
    font-weight: bold;
}

.body_location input[type="text"],
.body_location input[type="password"],
.body_location input[type="email"],
.body_location textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc; /* Gray border */
    border-radius: 5px;
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

.body_location input[type="submit"],
.body_location input[type="button"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50; /* Green background for buttons */
    color: #fff; /* White text color */
    cursor: pointer;
}

.body_location input[type="submit"]:hover,
.body_location input[type="button"]:hover {
    background-color: #45a049; /* Darker green on hover */
}

.body_location .upload_picture_location {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.body_location .upload_picture_location label {
    flex: 1;
}

.body_location a {
    text-align: center;
    color: black; 
    text-decoration: none;
    margin-top: 20px;
}

.body_location a:hover {
    text-decoration: underline; /* Underline on hover */
}

.user_upload_picture_form {
    margin-bottom: 20px;
    border: 1px solid black;
    padding: 10px;
    border-radius: 10px;
}

.user_upload_picture_form label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
}

#user_picture{
    width: 500px;
}

.upload_picture_location {
    display: flex;
    align-items: center;
}

#memberAddress{
    margin-left: 5px;
}



     </style>
</head>

<div class="body_location">

    <form action="register_new_user_process.php" method="post" enctype="multipart/form-data">
    <button onclick="location.href='user_login.php';" title="Back to User Login"><i class="fa-solid fa-circle-left"></i> Back</button>
        <h1>Register New Member</h1>

        <div class="user_upload_picture_form">
            <label for="user_picture">Upload Picture (Only JPG, PNG and WEBP are allowed.)<br> You also can upload picture later</label>
            <div class="upload_picture_location">
                <div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input id="user_picture" type="file" name="file" id="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
                </div>
            </div>
        </div>

        <br>
        
        <label for="memberNokp">ID :</label>
            
        <input type="text" name="memberNokp" id="memberNokp" placeholder=" without '-'" value="" required>

        <br><br>

        <label for="memberName">Name : </label>
        <input type="text" name="memberName" id="memberName" value="" required>

        <br><br>
        
        <label for="memberPass">Password : </label>
        <input type="password" name="memberPass" id="memberPass" value="" required>

        <br><br>

        <label for="memberCPass">Confirm Password : </label>
        <input type="password" name="memberCPass" id="memberCPass" value="" required>

        <br><br>

        <label for="memberPhone">Phone : </label>
        <input type="text" name="memberPhone" id="memberPhone" value="" placeholder="0123456789" required>

        <br><br>

        <label for="memberEmail">Email : </label>
        <input type="email" name="memberEmail" id="memberEmail" value="" required>

        <br><br>

        <label for="memberAddress" class="address_label">Address : </label>
        <textarea maxlength='200' name='memberAddress' id='memberAddress' rows='10' cols='60' style='max-width: 616px;' required></textarea>

        <br><br>

        <input type="submit" value="Register" name="Register">
        <br><br>
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

        <br><br>

        <a href="user_login.php"><p>Already Have Account? Login Here.</p></a>

    </form>

    <br>


</div>

<?php
    include('footer.php');
?>