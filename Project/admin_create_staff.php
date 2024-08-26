<?php
    session_start();
    include('header.php');
    include('connection.php');
    include('admin_check.php');
    include('permission_check.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_create_staff.css">
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

        .admin_upload_picture_form{
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

    <form action="admin_create_staff_process.php" method="post" enctype="multipart/form-data">
    <button onclick="location.href='admin_staff_manage.php';" title="Back to Staff Management"><i class="fa-solid fa-circle-left"></i> Back</button>
        <h1>Create New Staff</h1>

        <div class="admin_upload_picture_form">
            <label for="admin_picture">Upload Picture (Only JPG, PNG and WEBP are allowed.)<br> User can upload later also</label>
            <br>
            <div class="upload_picture_location">
                <div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input id="admin_picture" type="file" name="file" id="file" accept="image/jpeg, image/gif, image/png, image/webp" onchange="updateText()"/>
                </div>
            </div>
        </div>

        <br>
        
        <label for="adminNokp">IC Number :</label>
            
        <input type="text" name="adminNokp" id="adminNokp" placeholder=" without '-'" value="" required>

        <br><br>

        <label for="adminName">Name : </label>
        <input type="text" name="adminName" id="adminName" value="" required>

        <br><br>
        
        <label for="adminPass">Password : </label>
        <input type="password" name="adminPass" id="adminPass" value="" required>

        <br><br>

        <label for="adminCPass">Confirm Password : </label>
        <input type="password" name="adminCPass" id="adminCPass" value="" required>

        <br><br>

        <label for="adminEmail">Email : </label>
        <input type="email" name="adminEmail" id="adminEmail" value="" required>

        <br><br>

        <input type="submit" value="Create" name="Register">
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

    </form>

</div>

<?php
    include('footer.php');
?>