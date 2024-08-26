<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    
</head>

<!-- Read Data -->
<?php
    if(isset($_GET['item_id'])) {
        // Get the item_id from the URL
        $item_id = $_GET['item_id'];

        // Fetch user details based on item_id
        $sql = "SELECT * FROM item WHERE item_id = '$item_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $id = $row['item_id'];
            $name = $row['item_name'];
            $price = $row['item_price'];
            $point = $row['item_point'];
        }
    } else {
        echo "<p>No item ID provided.</p>";
        echo "<script>location.href='admin_item_manage.php'</script>";
    }
?>

<body>
    <div class="body_loaction">

    <button onclick="location.href='admin_item_manage.php'" title="Back to Item Check"><i class="fa-solid fa-circle-left"></i> Back</button>

    <br>
    <h2><u>Edit Item Details</u></h2>

        <!-- User Information -->
        <script>
                function resetValue(input_name, originalValue) {
                    document.getElementById(input_name).value = originalValue;
                }
            </script>     


        <form class="form_admin_edit_user" action='item_edit_process.php?item_id=<?php echo $id ?>' method='POST' enctype="multipart/form-data">


            <p>Original ID : <b><?php echo $id ?></b></p>   

            <label for="id_new">ID : </label>
            <input type='text' maxlength='12' name='id_new' id='id_new' value='<?php echo $id ?>' required>
            <button type="button" onclick="resetValue('id_new', '<?php echo $id ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="name">Name : </label>
            <input type='text' maxlength='60' name='name' id='name' value='<?php echo $name ?>' required>
            <button type="button" onclick="resetValue('name', '<?php echo $name ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="price">Price : </label>
            RM <input type='number' min="0.01" max="999.99" name='price' id='price'  step="0.01" value='<?php echo $price ?>' required> /KG
            <button type="button" onclick="resetValue('price', '<?php echo $price ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="point">Point = Price * 100</label>

            <br><br>
            
            <button type="submit">Submit</button>
            <button type="button" onclick="
                resetValue('price', '<?php echo $price ?>');
                resetValue('id_new', '<?php echo $id ?>');
                resetValue('name', '<?php echo $name ?>');
            ">Reset All</i></button>
        </form>

    </div>
        
    
</body>

<?php
    include('footer.php');
?>
