<?php
    session_start();
    include('header.php');
    include('admin_check.php');
?>

<head>
    <link rel="stylesheet" href="">
</head>

<!-- Read Data -->
<?php
    $nokp = $_SESSION['nokp'];
    $sql = "SELECT * FROM admin
            WHERE admin_nokp = '$nokp'";

    $result = mysqli_query($combine_data, $sql);
    if($result && mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        $id = $row['admin_nokp'];
        $password = $row['admin_password'];
        $picture = 'UPLOAD/Admin/' . $id . '.jpg';
    } 
?>

<body>
    <div class="body_location">

        <h2><u>Reset Password</u></h2>

        <form action='admin_reset_password_process.php?id=<?php echo $id ?>' method='POST'>

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
            
            <button type="submit">Submit</button>
            <button type="button" onclick="resetValue();">Reset All</i></button>
        </form>
    </div>
</body>


<?php
    include('footer.php');
?>
