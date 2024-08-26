<?php
    session_start();
    include('header.php');
?>

<head>
    <style>

.body_location {
    padding: 20px;
}


.body_location h1 {
    color: black; 
}


.body_location form {
    margin-bottom: 20px;
}


.body_location input[type="text"],
.body_location input[type="submit"],
.body_location input[type="button"] {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}


.body_location input[type="submit"] {
    background-color: #4CAF50; 
    color: white; 
    border: none;
    cursor: pointer;
}

.body_location input[type="button"] {
    background-color: #808080; 
    color: white; 
    border: none;
    cursor: pointer;
    margin-bottom: 10px;
}

.body_location table {
    width: 100%;
    border-collapse: collapse;
}


.body_location table th {
    background-color: #4CAF50;
    color: white; 
    padding: 10px;
    text-align: left;
}

.body_location table td {
    border: 1px solid #ddd;
    padding: 8px;
}

        </style>
</head>

<body>
    <div class="body_location">
        <h1>Item List</h1>

        <form action="" method="POST">
            <label for="id_item_search">Item Name : </label>
            <input type="text" id="id_item_search" name="item_name">
            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

        </form>

        <table width='100%' border='1'>
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Price</td>
                <td>Point Given</td>
            </tr>

            <?php
                if(isset($_POST['item_name'])) {
                    $search_name = $_POST['item_name'];
                    $sql = "SELECT * FROM item WHERE item_name LIKE '%$search_name%'";
                }else {
                    $sql = "SELECT * FROM item";
                }

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['item_id'];
                        $name = $row['item_name'];
                        $price = $row['item_price'];
                        $price = number_format($price, 2);
                        $point = $row['item_point'];

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $name ."</td>
                                <td>RM ". $price ." / KG</td>
                                <td>". $point ." / KG</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No items found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>

<?php
    include('footer.php');
?>