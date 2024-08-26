<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/admin_user_manage.css">
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
        <h1>Member Management</h1>

        <form action="" method="POST">
            <label for="id_member_search">Member ID : </label>
            <input type="text" id="id_member_search" name="member_id">
            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

        <a href="admin_create_user.php">[Create New Member Account]</a>

        <br><br>

        <table width='100%' border='1'>
            <tr>
                <td>No</td>
                <td>ID</td>
                <td>Name</td>
                <td>Point</td>
                <td>Action</td>
            </tr>

            <?php
                if(isset($_POST['member_id'])) {
                    $search_id = $_POST['member_id'];
                    $sql = "SELECT * FROM member WHERE member_nokp LIKE '%$search_id%'";
                } else {
                    $sql = "SELECT * FROM member";
                }

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['member_nokp'];
                        $name = $row['member_name'];
                        $phone = $row['member_phone'];
                        $email = $row['member_email'];
                        $address = $row['member_address'];
                        $point = $row['member_point'];
                        $picture = 'UPLOAD/Member/' . $id . '.jpg';

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $id ."</td>
                                <td>". $name ."</td>
                                <td>". $point ."</td>
                                <td>
                                    <button onclick=\"location.href='admin_view_user.php?member_id=" .$id."'\">
                                        <i class='fa-solid fa-magnifying-glass'></i>
                                        View Member
                                    </button> 
                                    | 
                                    <button onclick=\"location.href='admin_add_point.php?member_id=" .$id."'\">
                                        <i class='fa-solid fa-recycle'></i>
                                        Admin Local Recycle
                                    </button>


                                    
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No members found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>

<?php
    include('footer.php');
?>