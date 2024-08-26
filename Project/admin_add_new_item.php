<?php
    session_start();
    include('header.php');
    include('connection.php');
    include('admin_check.php');
?>

<head>
    <link rel="stylesheet" href="CSS/register_new_user.css">
    <style>

.body_location {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 120%;
    background-color: #f0f0f0; 
}
.button {
    background-color: #008000;
    color: #ffffff;
    padding: 10px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
    border-radius: 5px;
        }

.button:hover {
    background-color: #006400;
}


.body_location form {
    background-color: #fff; 
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    width: 800px;
    max-width: 100%;
    margin:25px 25px;
}


.body_location h1 {
    text-align: center;
    margin-bottom: 20px;
    color: black; 
}

.body_location label {
    font-weight: bold;
}

.body_location input[type="text"]{
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc; 
    border-radius: 5px;
    box-sizing: border-box; 
}

.body_location input[type="submit"],
.body_location input[type="button"] {
    width: 100%;
    margin:10px 0px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50; 
    color: #fff; 
    cursor: pointer;
}

.body_location input[type="submit"]:hover,
.body_location input[type="button"]:hover {
    background-color: #45a049; 
}

</style>

</head>

<div class="body_location">

    <form action="admin_add_new_item_process.php" method="post">
    <button onclick="location.href='admin_item_manage.php';" title="Back to Item Management"><i class="fa-solid fa-circle-left"></i> Back</button>
        <h1>Add New Item</h1>
        
        <label for="itemID">Item ID :</label>
            
        <input type="text" name="itemID" id="itemID" value="" required>

        <br><br>

        <label for="itemName">Name : </label>
        <input type="text" name="itemName" id="itemName" value="" required>

        <br><br>

        <label for="itemPrice">Price : </label>
        RM <input type="number" max="999.99" min="0.01" step="0.01" name="itemPrice" id="itemPrice" value="" required> / KG

        <br><br>

        <label for="point">Point = Price * 100</label>

        <br><br>

        <input type="submit" value="Add" name="Add">
        <input type="button" value="RESET" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

    </form>

</div>

<?php
    include('footer.php');
?>