<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
    <style>
        .body_location form {
        margin-bottom: 20px;
        }

        label[for="hidden"],label[for="show"],label[for="all"] {
        font-style: oblique;
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

        .body_location input[type="submit"]:hover{
        background-color: #45a049; /* Darker green on hover */
        }

        .body_location input[type="button"]:hover { 
        background-color: #666666; 
    }
        .body_location table {
        width: 100%;
        border-collapse: collapse;
        }

        .body_location table td {
        border: 1px solid #ddd;
        padding: 8px;
        }

    </style>

        </style>
</head>

<body>
    <div class="body_location">
        <h1>Point History</h1>

        <form action="" method="POST">
            <label for="member_name_search">Member Name : </label>
            <input type="text" id="member_name_search" name="member_name">
            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">

        </form>

        <table width='100%' border='1'>
            <tr>
                <td>No</td>
                <td>Member ID</td>
                <td>Member Name</td>
                <td>Event Name</td>
                <td>Point</td>
                <td>Datetime</td>
            </tr>

            <?php
                if(isset($_POST['member_name'])) {
                    $search_name = $_POST['member_name'];
                    $sql = "SELECT member_id, point_get, datetime_history, event_name, member_name
                    FROM point_history 
                    INNER JOIN event ON point_history.event_id = event.event_id 
                    INNER JOIN member ON point_history.member_id = member.member_nokp
                    WHERE member_name LIKE '%$search_name%'";
                }else {
                    $sql = "SELECT member_id, point_get, datetime_history, event_name, member_name 
                    FROM point_history 
                    INNER JOIN event ON point_history.event_id = event.event_id 
                    INNER JOIN member ON point_history.member_id = member.member_nokp";
                }

                $bil=0;

                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $member_id = $row['member_id'];
                        $member_name = $row['member_name'];
                        $event_name = $row['event_name'];
                        $point = $row['point_get'];
                        $datetime = $row['datetime_history'];

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $member_id ."</td>
                                <td>". $member_name ."</td>
                                <td>". $event_name ."</td>
                                <td>". $point ."</td>
                                <td>". $datetime ."</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No items found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>

<?php
    include('footer.php');
?>