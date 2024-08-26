<?php
    session_start();
    include('header.php');
    include('user_check.php');
?>

<head>
    <link rel="stylesheet" href="CSS/user_reset_password.css">
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.body_location {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 35px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.body_location h2 {
    color: black; 
    margin-top: 0;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="password"] {
    width: calc(100% - 12px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}


.button {
    padding: 10px 20px;
    background-color: #008000; 
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

.button:hover {
    background-color: #006400; 
}
        </style>
</head>

<!-- Read Data -->
<?php
    $nokp = $_SESSION['nokp'];
    $sql = "SELECT * FROM member
            WHERE member_nokp = '$nokp'";

    $result = mysqli_query($combine_data, $sql);
    if($result && mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        $id = $row['member_nokp'];
        $password = $row['member_password'];
        $picture = 'UPLOAD/Member/' . $id . '.jpg';
    } 
?>

<body>
    <div class="body_location">

        <h2><u>Reset Password</u></h2>

        <form action='user_reset_password_process.php?id=<?php echo $id ?>' method='POST'>

        <script>
            function resetValue() {
                document.getElementById("CurrentPass").value = "";
                document.getElementById("NewPass").value = "";
                document.getElementById("ConfirmPass").value = "";
            }
        </script>             
            <label for="CurrentPass">Current Password : </label>
            <input type='password' maxlength='20' name='CurrentPass' id='CurrentPass' value='' required>

            <br><br>

            <label for="NewPass">New Password : </label>
            <input type='password' maxlength='20' name='NewPass' id='NewPass' value='' required>

            <br><br>

            <label for="ConfirmPass">Confirm Password : </label>
            <input type='password' maxlength='20' name='ConfirmPass' id='ConfirmPass' value='' required>

            <br><br>
            
            <button class="button" type="submit">Submit</button>
            <button class="button" type="button" onclick="resetValue();">Reset All</i></button>
        </form>
    </div>
</body>


<?php
    include('footer.php');
?>
