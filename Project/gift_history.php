<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <style>
        .body location {
        justify-content: center;
        align-items: center;
        height: 600px;
        background-color: #f0f0f0; 
        /* Light gray background */
        }

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
            
            <br><br>

            <label for="gift_approve">Gift Status : </label>
            <input type="radio" id="hidden" name="gift_approve" value="1">
            <label for="hidden">Already Reddem</label>
            <input type="radio" id="show" name="gift_approve" value="2">
            <label for="show">Pending</label>
            <input type="radio" id="all" name="gift_approve" value="" checked="checked">
            <label for="all">Show All</label>

            <br><br>
            
            <input type="submit" value="Search">
            <input type="button" value="Reset Filter" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
        </form>

        <br>
            <table border="1" width="100%">
                <tr>
                    <td>No</td>
                    <td>Gift Name</td>
                    <td>Point</td>
                    <td>Datetime</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

            <?php
                $member_id = $_SESSION['nokp'];
                $sql = "SELECT gift_approve.exchange_datetime, gift_approve.no_gift_history, gift_approve.point, gift_approve.approve, gift.gift_name ,member.member_name, member.member_nokp
                        FROM gift_approve
                        INNER JOIN member ON gift_approve.member_id = member.member_nokp 
                        INNER JOIN gift ON gift_approve.gift_id = gift.gift_id 
                        WHERE gift_approve.member_id = $member_id";

                // Check for event name search
                if(isset($_POST['gift_name']) && !empty($_POST['gift_name'])) {
                    $search_name = $_POST['gift_name'];
                    $sql .= " AND gift_name LIKE '%$search_name%'";
                }

                if(isset($_POST['gift_approve']) && !empty($_POST['gift_approve'])){
                    if($_POST['gift_approve'] == 1){
                        $sql .= " AND approve LIKE '1'";
                    }else if($_POST['gift_approve'] == 1){
                        $sql .= " AND approve LIKE '0'";
                    }
                }

                $bil=0;
                
                $result = mysqli_query($combine_data, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $no_history = $row['no_gift_history'];
                        $id = $row['member_nokp'];
                        $name = $row['member_name'];
                        $gift_name = $row['gift_name'];
                        $point = $row['point'];
                        $date = $row['exchange_datetime'];
                        $approve = $row['approve'];

                        if($approve != 0){
                            $approve = "Already Redeem";
                            $action = "";
                        }else{
                            $approve = "Pending";
                            $action = "<button onclick=\"if(confirm('Click OK to approve this gift data.')) { location.href='gift_approve_process.php?no_history=$no_history&member_id=$id'; }\" title='Click to Approve This gift data!'><i class='fa-solid fa-file-circle-check'></i>Approve</button>";
                        }

                        echo "<tr>
                                <td>".++$bil."</td>
                                <td>". $gift_name ."</td>
                                <td>-".$point ."</td>
                                <td>". $date ."</td>
                                <td>". $approve ."</td>
                                <td>". $action ."</td>
                              </tr>";
                    }
                }else{
                    echo "<tr>
                            <td colspan='6'>No history data</td>
                        </tr>";
                }
            ?>
            </table>
    </div>
</body>

<?php
    include('footer.php');
?>