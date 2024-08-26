<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/edit_admin_details.css">
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
        $name = $row['admin_name'];
        $email = $row['admin_email'];
        $picture = 'UPLOAD/Admin/' . $id . '.jpg';
    } 
?>

<body>
    <div class="body_location">
        <button onclick="location.href='admin_account_details.php';" title="Back to account details"><i class="fa-solid fa-circle-left"></i> Back</button>


        <h2><u>Edit Admin Details</u></h2>
        <p>Original ID : <b><?php echo $id ?></b></p>   

        <form action='edit_admin_details_process.php?id=<?php echo $id ?>' method='POST'>

        <script>
            function resetValue(input_name, originalValue) {
                document.getElementById(input_name).value = originalValue;
            }
        </script>             
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
</body>

<?php
    include('footer.php');
?>
