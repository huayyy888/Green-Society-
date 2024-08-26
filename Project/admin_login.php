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
    
    $adminNokp=$adminPass='';
    $error=array('adminNokp'=>'','adminPass'=>'');
    $success = 0;
    if(isset($_POST['login'])){ // if form got value when press LOGIN
        
        // ic num
        if(empty($_POST['adminNokp'])){
            $error['adminNokp']= "Please enter ID";
        }else{
            $adminNokp=$_POST['adminNokp'];
        }
        
        //admin password
        if(empty($_POST['adminPass'])){ 
            $error['adminPass']= "Please enter Password";
        }
        else{
            $adminPass=$_POST['adminPass'];
        } 
        
        $login_sql = "SELECT * FROM admin WHERE admin_nokp='$adminNokp' && admin_password='$adminPass'";
        
        $result = $combine_data->query($login_sql);
        
        if ($result->num_rows == 1){
            while ($row = $result->fetch_object()){
                $_SESSION['nokp'] = $adminNokp;
                $_SESSION['account_type'] = "admin";

                $adminNokp=$adminPass='';

                $success = 0;

                echo("
                <script>
                    alert('Login Success');
                    window.location.href='index.php';
                </script>
                ");
            }
        }else{
            $adminNokp=$adminPass='';
            $success = 1;
        }
        
    }
            
?>

<div class="body_location">
<div class="container">
    <form action="admin_login.php" method="post">
    
    <h1>Admin Login</h1>

    <?php
    if(isset($_POST['adminNokp']) && isset($_POST['adminNokp'])){
        if($success == 1){
            ?>
            <div class="error-message"> 
            <?php
            echo "Wrong ID or Password. Please Enter Again.";
            ?>
            </div>
            <?php
        }
    }
    
    ?>

        <label for="adminNokp">ID : </label>
        <input type="text" name="adminNokp" id="adminNokp" value="">
        <?php if(isset($error['adminNokp']) && !empty($error['adminNokp'])) { ?>
            <div class="error-message">
                <?php echo $error['adminNokp']; ?>
            </div>
        <?php }else{ 
            echo "<br>";
        } ?>

        <br>
        
        <label for="adminPass">Password : </label>
        <input type="password" name="adminPass" id="adminPass" value="">
        <?php if(isset($error['adminPass']) && !empty($error['adminPass'])) { ?>
            <div class="error-message">
                <?php echo $error['adminPass']; ?>
            </div>
        <?php }else{ 
            echo "<br>";
        } ?>

        <br>

        <input type="submit" value="Login" name="login">
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

    </form>
    </div>
</div>

<?php
    include('footer.php');
?>