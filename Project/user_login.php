<?php
    session_start();
    include('header.php');
    include('connection.php');
    include('account_function.php');
?>

<head>
    <link rel="stylesheet" href="CSS/account_login.css">
    
    <style>


        .body_location {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f0f0f0; 
            background-image: url("PIC/background/background_1.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            opacity: 0.8;
            margin:0;
        }

        .body_location form {
            background-color: #fff; 
            padding: 20px;
            margin: 100px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            width: 400px;

        }

        .body_location h1 {
            text-align: center;
            margin-bottom: 20px;
            color:black; 
        }

        .body_location label {
            font-weight: bold;
        }

        .body_location input[type="text"],
        .body_location input[type="password"],
        .body_location input[type="submit"],
        .body_location input[type="button"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc; 
            border-radius: 5px;
            box-sizing: border-box; 
        }

        .body_location input[type="submit"],
        .body_location input[type="button"] {
            background-color:#4CAF50; 
            color: #fff; 
            cursor: pointer;
        }

        .body_location input[type="submit"]:hover,
        .body_location input[type="button"]:hover {
            background-color:  #45a049; 
        }

        .body_location a {
            text-align: center;
            color: black; 
            text-decoration: none;
            margin-top: 20px;
        }

        .body_location a:hover {
            text-decoration: underline; 
        }
    </style>
</head>

<?php
    
    $memberNokp=$memberPass='';
    $error=array('memberNokp'=>'','memberPass'=>'');
    $success = 0;
    if(isset($_POST['login'])){ // if form got value when press LOGIN
        
        // ic num
        if(empty($_POST['memberNokp'])){
            $error['memberNokp']= "Please enter ID";
        }else{
            $memberNokp=$_POST['memberNokp'];
        }
        
        //member password
        if(empty($_POST['memberPass'])){ 
            $error['memberPass']= "Please enter Password";
        }
        else{
            $memberPass=$_POST['memberPass'];
        } 
        
        $login_sql = "SELECT * FROM member WHERE member_nokp='$memberNokp' && member_password='$memberPass'";
        
        $result = $combine_data->query($login_sql);
        
        if ($result->num_rows == 1){
            while ($row = $result->fetch_object()){
                $_SESSION['nokp'] = $memberNokp;
                $_SESSION['account_type'] = "user";

                $memberNokp=$memberPass='';

                $success = 0;

                echo("
                <script>
                    alert('Login Success');
                    window.location.href='index.php';
                </script>
                ");
            }
        }else{
            $memberNokp=$memberPass='';
            $success = 1;
        }
        
    }
            
?>

<div class="body_location">
    <form action="user_login.php" method="post">
    
    <h1>Member Login</h1>

    <?php
    if(isset($_POST['memberNokp']) && isset($_POST['memberNokp'])){
        if($success == 1){
            ?>
            <div class="error-message"> 
            <?php
            echo "Wrong ID or Password. Please Enter Again.";
            ?>
            </div>
            <br>
            <?php
        }
    }
    
    ?>

        <label for="memberNokp">ID : </label>
        <input type="text" name="memberNokp" id="memberNokp" value="">
        <?php if(isset($error['memberNokp']) && !empty($error['memberNokp'])) { ?>
            <div class="error-message">
                <?php echo $error['memberNokp']; ?>
            </div>
        <?php }else{ 
            echo "<br>";
        } ?>

        <br>
        
        <label for="memberPass">Password : </label>
        <input type="password" name="memberPass" id="memberPass" value="">
        <?php if(isset($error['memberPass']) && !empty($error['memberPass'])) { ?>
            <div class="error-message">
                <?php echo $error['memberPass']; ?>
            </div>
        <?php }else{ 
            echo "<br>";
        } ?>

        <br>

        <input type="submit" value="Login" name="login">
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

        <a href="register_new_user.php"><p>Not yet have Account? Register Here.</p></a>
    </form>

    <br>


</div>

<?php
    include('footer.php');
?>