<?php
    session_start();
    include('header.php');
    include('connection.php');
    include('admin_check.php');
?>

<head>
    <link rel="stylesheet" href="CSS/register_new_user.css">
    <style>
        /* Style for the body */
        .body_location {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 120%;
            background-color: #f0f0f0; /* Light gray background */
        }

        .user_upload_picture_form{
        border: 1px solid black;
        padding: 10px;
        width: 480px;
        border-radius: 10px;
        }


        /* Style for the form container */
        .body_location form {
            background-color: #fff; /* White background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle effect */
            width: 500px;
            margin:25px 25px;
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

        .body_location input[type="text"], .body_location input[type="password"], .body_location input[type="email"], #memberAddress{
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Gray border */
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }

        .address_label{
            float:left;
        }

        label[for="adminNokp"],label[for="adminName"],label[for="adminPass"],label[for="adminCPass"],label[for="adminEmail"]{
            font-size:20px;
        }

        .body_location input[type="submit"],
        .body_location input[type="button"] {
            width: 100%;
            margin:10px 0px;
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
    </style>
</head>

<div class="body_location">

    <form action="admin_create_user_process.php" method="post" enctype="multipart/form-data">
    <button onclick="location.href='admin_user_manage.php';" title="Back to Member Management"><i class="fa-solid fa-circle-left"></i> Back</button>
        <h1>Create New Member</h1>

        <div class="user_upload_picture_form">
            <label for="user_picture">Upload Picture (Only JPG, PNG and WEBP are allowed.)<br> User can upload later also</label>
            <br>
            <div class="upload_picture_location">
                <div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input id="user_picture" type="file" name="file" id="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
                </div>
            </div>
        </div>

        <br>
        
        <label for="memberNokp">IC Number :</label>
            
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
        <br>
        <textarea maxlength='200' name='memberAddress' id='memberAddress' rows='10' cols='60' style='max-width: 616px;' required></textarea>

        <br>

        <input type="submit" value="Register" name="Register">
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

    </form>

</div>

<?php
    include('footer.php');
?>