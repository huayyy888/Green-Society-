<?php
    session_start();
    include('user_check.php');
    include('header.php');
    include('connection.php');
?>

<head>
    <link rel="stylesheet" href="PRINT/print_user_eventE003.css" media="print">

    <style>

body {
    font-family: Arial, sans-serif;
    margin: 50;
    padding: 0;
}
.body_location{
    margin:30px;
}

h1 {
    color: #333;
}


input[type="text"],
input[type="number"],
select {
    width: 200px;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}


.button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.button:hover {
    background-color: #45a049;
}


table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.back-button {
    background-color: #ccc; 
    color: #333; 
    border: none;
    padding: 10px 20px;
    margin-bottom: 20px;
    cursor: pointer;
    border-radius: 5px;
}

.back-button:hover {
    background-color: #bbb; 
}

.body_location button[type="submit"] {
    background-color: #4CAF50; 
    color: #fff; 
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.body_location button[type="submit"]:hover {
    background-color: #45a049; 
}

.delete-btn{
    margin-left: auto;
    margin-right: auto;
    width: 51.66px;
}

.total{
    border-top: 2px solid gray;
    border-bottom: 2px solid gray;
}

.area_select{
    display: flex;
}

.label_area{
    padding-top:7px;
    height:30px;
}

#area_name{
    margin-left:5px;
}

.account_details{
    border: 1px solid black;
    padding: 10px;
    border-radius: 10px;
    width: 600px;
}

.print_button{
    margin-left:5px;
    padding-top: 0;
    padding-bottom: 0;
    height:35px;
}

.upload_pdf{
    border: 1px solid black;
    border-radius: 10px;
    padding: 10px;
    width: 700px;
}

        </style>
</head>

<script>
    function printScreen(tableNo) {
        var areaName = document.getElementById("area_name").value;
        if (areaName === "") {
            alert("Please select an area name before print.");
        } else {
            if (tableNo <= 0) {
                alert("Don't have any data in table.");
            } else {
                window.print();
            }
        }
    }
</script>

<body>

    <?php 
    $sql = "SELECT * FROM event WHERE event_id = 'E003'";
    $result = mysqli_query($combine_data, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        // Fetch user details
        $row = mysqli_fetch_assoc($result);
        $id = $row['event_id'];
        $name = $row['event_name'];
        $type = $row['event_type'];
        $join_type = $row['event_join_type'];
        $description = $row['event_description'];
        $location = $row['event_location'];
        $date = $row['event_date'];
    }else{
        echo "<script>history.go(-1);</script>";
    }

    $login_id = $_SESSION['nokp'];
    $sql_user = "SELECT * FROM member WHERE member_nokp = $login_id";
    $result_user = mysqli_query($combine_data, $sql_user);

    if($result_user && mysqli_num_rows($result_user) > 0) {
        $row = mysqli_fetch_assoc($result_user);
        $member_id = $row['member_nokp'];
        $member_name = $row['member_name'];
        $member_phone = $row['member_phone'];
        $member_email = $row['member_email'];
        $member_address = $row['member_address'];
    }
    ?>

    <?php
        // Handle form submission
        if (isset($_POST['item_name']) && isset($_POST['quantity'])) {
            // Retrieve item ID and quantity from the form
            $item_id = $_POST['item_name'];
            $quantity = $_POST['quantity'];

            // Fetch item details from the database
            $sql_item_details = "SELECT * FROM item WHERE item_id = '$item_id'";
            $result_item_details = mysqli_query($combine_data, $sql_item_details);

            if ($result_item_details && mysqli_num_rows($result_item_details) > 0) {
                $row = mysqli_fetch_assoc($result_item_details);
                $item_name = $row['item_name'];
                $item_price = $row['item_price'];
            
                // Calculate total cost
                $total = $item_price * $quantity;

                $no = $_SESSION['no_table'];

                $sql_no_details = "SELECT no FROM temp_add_item_e003";
                $result_item_no = mysqli_query($combine_data, $sql_no_details);
                $row = mysqli_fetch_assoc($result_item_no);
                if($result_item_no && mysqli_num_rows($result_item_no) < 1){
                    $_SESSION['no_table'] = 1;
                    $no = 1;
                }

                if($no > 0){
                    $sql_add_to_temp = "INSERT INTO temp_add_item_e003 (no, item_id, quantity, total)
                    VALUES ('$no', '$item_id', '$quantity', '$total')";

                    $_SESSION['no_table']++;

                    if(mysqli_query($combine_data, $sql_add_to_temp)) {
                        // Reset POST
                        echo "<script>window.location.href='user_eventE003.php';</script>";
                    }else{
                        echo "<script>alert('Error! Can't add item.');</script>";
                    }
                }
            } else {
                echo "<script>alert('Error! Can't add item.');</script>";
            }
            
        }
    ?>

    <?php
    // Delete Col
        if(isset($_POST['delete_item'])) {
            $delete_item_id = $_POST['delete_item_id'];
            $sql_delete_item = "DELETE FROM temp_add_item_e003 WHERE no = '$delete_item_id'";
            if(mysqli_query($combine_data, $sql_delete_item)) {
                // Delete 
            } else {
                echo "<script>alert('Error! Failed to delete item.');</script>";
            }
        }
    ?>

    <div class="body_location">
    <button class="button back-button hide-print" onclick="location.href='event_list.php'" title="Back to Event List"><i class="fa-solid fa-circle-left"></i> Back</button>


        <h1><u><?php echo $name ?></u></h1>

        <div class="account_details">
            <h3>Account Details:</h3>
            <p>Time : <?php echo date("Y-m-d h:i:s"); ?></p>
            <p>Current ID : <?php echo $member_id ?></p>
            <p>Name : <?php echo $member_name ?></p>
            <p>Contact : <br>(Phone) <?php echo $member_phone ?> <br>(Email) <?php echo $member_email ?> </p>
            <p>Address : <?php echo $member_address ?></p>

            <button class="button hide-print" onclick="location.href='user_account_details.php'" title="Edit Details">Edit Details</button>
        </div>

        <form action="" method="post" class="add_item_form">
            <h3>Add Items:</h3>
            <label for="item_name">Item Name : </label>
            <select name="item_name" id="item_name" required>
                <option value="" disabled selected>Select your item</option>
                <?php
                    $sql_item = "SELECT * FROM item";
                    $result_item = mysqli_query($combine_data, $sql_item);
                    while ($row = mysqli_fetch_assoc($result_item)) {
                        echo "<option value='" . $row['item_id'] . "'>" . $row['item_name'] . "</option>";
                    }
                ?>
            </select>

            <br>
            
            <label for="quantity">Quantity (minimum 1KG) : </label>
            <input type="number" id="quantity" name="quantity" min="1" max="999" required> KG

            <br>

            <button class="button" type="reset">Reset</button>
            <button class="button" type="add">Add</button>
        </form>
        
        <br>

        <table width="100%" border="1">
            <tr>
                <td width="10px">No</td>    
                <td>Item Name</td>
                <td>Price</td>
                <td width="20%">Quantity (KG)</td>
                <td width="20%">Total Point<br>( Price * 100)</td>
                <td width="80px" class="hide-item">Delete Item</td>
            </tr>
            
            <?php

                // JOIN DATA TOGETHER
                $sql_display_table = "SELECT temp.*, item.item_name, item.item_price FROM temp_add_item_e003 AS temp INNER JOIN item ON temp.item_id = item.item_id";

                $table_no = $all_total = 0;
                $table_display = mysqli_query($combine_data, $sql_display_table);
                if ($table_display && mysqli_num_rows($table_display) > 0) {
                    while ($row = mysqli_fetch_assoc($table_display)) {
                        $table_no++;
                        $data_no_table = $row['no'];
                        $item_name = $row['item_name'];
                        $item_price = $row['item_price'];
                        $quantity_table = $row['quantity'];
                        $total = $row['total'] * 100;

                        $all_total = $all_total + $total;

                        echo "<tr>
                            <td>" . $table_no . "</td>
                            <td>" . $item_name . "</td>
                            <td>RM" . $item_price . " / KG</td>
                            <td>" . $quantity_table . "</td>
                            <td>" . $total . "</td>
                            <td class='hide-item delete-btn'><form class='delete-btn' method='post'><input type='hidden' name='delete_item_id' value='" . $data_no_table . "'><button class='button' type='submit' class='delete-btn' name='delete_item'><i class='fa-solid fa-trash-can'></i></button></form></td>
                        </tr>";
                    }
                    echo "<tr>
                            <td colspan='3'></td>
                            <td class='total'>Total Point :</td>
                            <td class='total'>" . $all_total  . "</td>
                            <td class='hide-item'></td>
                        </tr>";
                } else {
                    echo "<tr><td colspan='6'>No items found.</td></tr>";
                }
            ?>
                
        </table>
                
        <br>

        <button class="button hide-item" onclick="if(confirm('Click OK to delete all table data.')) { location.href='E003_delete_all_data.php'; }" title="Click to Delete All Table Data!"><i class="fa-solid fa-trash-can"></i> Delete All Table Data</button>
        
        <div class="hide-print">
            <br><br>
        </div>

        <form action="E003_data_submit_process.php?total=<?php echo $all_total; ?>" method="POST" onsubmit="return confirm('Click OK to submit the data.');" enctype="multipart/form-data">

            <div class="area_select">

            <label for="area_name" class="label_area">Area Name : </label>
            <select name="area_name" id="area_name" required>
                <option value="" disabled selected>Select your area</option>
                <?php
                    $sql_item = "SELECT * FROM recycle_area";
                    $result_item = mysqli_query($combine_data, $sql_item);
                    while ($row = mysqli_fetch_assoc($result_item)) {
                        $area_combine = $row['area_location'] . " - " . $row['area_id'];
                        echo "<option value='" . $row['area_id'] . "'>" . $area_combine . "</option>";
                    }                    
                ?>
            </select>
        
            <button type="button" class="button hide-item print_button" onclick="printScreen(<?php echo $table_no; ?>)" title="Print Screen">Print Screen</button>

            </div>

            <br>

            <div class="hide-item upload_pdf">
                <label for="file">Upload Your Print Screen Here in PDF file:</label>
                <input id="file" type="file" name="file" accept=".pdf" required/>
            </div>

            <br><br>

            <button class="button hide-item" type="submit" title="Click to Submit The Data!"><i class="fa-solid fa-check"></i> Click to Submit The Data</button>

        </form>

    </div>
</body>

<?php
    include('footer.php');
?>