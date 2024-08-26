<?php
    session_start();
    include('user_check.php');
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

    <?php 
        if(isset($_GET['event_id'])) {
            // Get the event_id from the URL
            $event_id = $_GET['event_id'];
    
            echo "<script>location.href='event_details.php?event_id=$event_id'</script>";
        }
    ?>

    <div class="body_location">
        <h1>Gift History</h1>

        <form action="" method="POST">
            <label for="gift_name">Gift Name : </label>
            <input type="text" id="gift_name" name="gift_name">

            
            <input type="submit" value="Search">
            <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>
            <table border="1" width="100%">
                <tr>
                    <td>No</td>
                    <td>Gift Name</td>
                    <td>Point</td>
                    <td>Datetime</td>
                    <td>Status</td>
                </tr>

            <?php
                $member_id = $_SESSION['nokp'];
                $sql = "SELECT gift_approve.exchange_datetime, gift_approve.point, gift_approve.approve, gift.gift_name ,member.member_name
                        FROM gift_approve
                        INNER JOIN member ON gift_approve.member_id = member.member_nokp 
                        INNER JOIN gift ON gift_approve.gift_id = gift.gift_id 
                        WHERE gift_approve.member_id = $member_id";

                // Check for event name search
                if(isset($_POST['gift_name']) && !empty($_POST['gift_name'])) {
                    $search_name = $_POST['gift_name'];
                    $sql .= " AND gift_name LIKE '%$search_name%'";
                }

                $bil=0;
                
                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['member_name'];
                        $gift_name = $row['gift_name'];
                        $point = $row['point'];
                        $date = $row['exchange_datetime'];
                        $approve = $row['approve'];

                        if($approve != 0){
                            $approve = "Already Redeem";
                        }else{
                            $approve = "Pending";
                        }

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $gift_name ."</td>
                                <td>-".$point ."</td>
                                <td>". $date ."</td>
                                <td>". $approve ."</td>
                              </tr>";
                    }
                }else{
                    echo "<tr>
                            <td colspan='5'>No history data</td>
                        </tr>";
                }
            ?>
            </table>
    </div>
</body>

<?php
    include('footer.php');
?>