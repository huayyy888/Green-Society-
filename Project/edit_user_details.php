<?php
    session_start();
    include('user_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/edit_user_details.css">
</head>

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

        .body_location input[type="text"], .body_location input[type="password"], .body_location input[type="email"], #address{
            width: 360px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Gray border */
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }

        #address{
            margin-left: 5px;
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

            .reset{
                margin-top: 0px;
                float: right;
            }
</style>

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
    <div class="body_location">

        <form action='edit_user_details_process.php?id=<?php echo $id ?>' method='POST'>

        <button class="button" onclick="location.href='user_account_details.php';" title="Back to account details"><i class="fa-solid fa-circle-left"></i> Back</button>

        <h1><u>Edit User Details</u></h1>
        <p>Original ID : <b><?php echo $id ?></b></p>   

        <script>
            function resetValue(input_name, originalValue) {
                document.getElementById(input_name).value = originalValue;
            }
        </script>             
            <label for="id_new">ID : </label>
            <input type='text' maxlength='12' name='id_new' id='id_new' value='<?php echo $id ?>' required>
            <button class="button reset" type="button" onclick="resetValue('id_new', '<?php echo $id ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="name">Name : </label>
            <input type='text' maxlength='60' name='name' id='name' value='<?php echo $name ?>' required>
            <button class="button reset" type="button" onclick="resetValue('name', '<?php echo $name ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="phone">Phone : </label>
            <input type='text' maxlength='11' name='phone' id='phone' value='<?php echo $phone ?>' required>
            <button class="button reset" type="button" onclick="resetValue('phone', '<?php echo $phone ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>
            
            <label for="email">Email : </label>
            <input type='email' maxlength='50' name='email' id='email' value='<?php echo $email ?>' required>
            <button class="button reset" type="button" onclick="resetValue('email', '<?php echo $email ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>
            

            <label for="address" class="address_label">Address : </label>
            <textarea maxlength='200' name='address' id='address' rows='10' cols='60' style='max-width: 616px;' required><?php echo $address ?></textarea>
            <button class="button reset" type="button" onclick="resetValue('address', '<?php echo $address ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>
            
            <button class="button" type="submit">Submit</button>
            <button class="button" type="button" onclick="
                resetValue('address', '<?php echo $address ?>');
                resetValue('id_new', '<?php echo $id ?>');
                resetValue('name', '<?php echo $name ?>');
                resetValue('phone', '<?php echo $phone ?>');
                resetValue('email', '<?php echo $email ?>');
                resetValue('address', '<?php echo $address ?>');
            ">Reset All</i></button>
        </form>
    </div>
</body>

<?php
    include('footer.php');
?>
