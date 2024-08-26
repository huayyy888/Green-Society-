<?php
    session_start();
    include('admin_check.php');
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

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

        </style>

</head>

<body>
    <div class="body_location">
        <button onclick="location.href='admin_event_manage.php'" title="Back to Event Check"><i class="fa-solid fa-circle-left"></i> Back</button>

        <h1>Gift Management</h1>

        <form action="" method="POST">
            <label for="id_gift_search">Gift Name : </label>
            <input type="text" id="id_gift_search" name="gift_name">
            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

        <a href="gift_create_new.php">[Add New Gift]</a>

        <br><br>

        <table width='100%' border='1'>
            <tr>
                <td>No</td>
                <td>ID</td>
                <td>Name</td>
                <td>Stock</td>
                <td>Point Need</td>
                <td>Action</td>
            </tr>

            <?php
                if(isset($_POST['gift_name'])) {
                    $search_name = $_POST['gift_name'];
                    $sql = "SELECT * FROM gift WHERE gift_name LIKE '%$search_name%'";
                }else {
                    $sql = "SELECT * FROM gift";
                }

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['gift_id'];
                        $name = $row['gift_name'];
                        $stock = $row['gift_stock'];
                        $point = $row['gift_point'];

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $id ."</td>
                                <td>". $name ."</td>
                                <td> ". $stock ."</td>
                                <td>". $point ."</td>
                                <td>
                                    <button onclick=\"location.href='gift_edit_menu.php?gift_id=" .$id."'\">
                                        <i class='fa-solid fa-magnifying-glass'></i>
                                        Edit
                                    </button>
                                    |
                                    <button onclick=\"if(confirm('Click OK to delete this gift.')) { location.href='gift_delete_process.php?gift_id=$id'; }\" title='Click to Delete This Gift!'>
                                        <i class='fa-solid fa-trash'></i>
                                        Delete
                                    </button>
                                
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No gifts found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>

<?php
    include('footer.php');
?>