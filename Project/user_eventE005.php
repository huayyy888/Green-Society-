<?php
    session_start();
    include('user_check.php');
    include('header.php');
    include('connection.php');
?>

<head>
    <style>

.poppins-thin {
  font-family: "Poppins", sans-serif;
  font-weight: 100;
  font-style: normal;
}

.body_location button {
    background-color: #808080; /* Grey background */
    color: #fff; /* White text color */
    border: none;
    padding: 10px 20px;
    margin-bottom: 20px;
    cursor: pointer;
    border-radius: 5px;
}

.body_location button:hover {
    background-color: #555; /* Darker grey on hover */
}

/* Style for headings */
.body_location h1, .body_location h3 {
    color: black; /* Green color for headings */
    margin: 30px;
}

/* Style for account details */
.body_location p {
    margin-bottom: 10px;
}

/* Style for gift items */
.body_location div {
    margin-bottom: 20px;
    border: 1px solid #ccc; /* Grey border */
    padding: 20px;
    border-radius: 5px;
    margin: 30px;
    font-family:
}

.body_location #picture_gift {
    max-width: 200px; /* Adjust image width */
    margin-bottom: 10px;
}

.body_location button {
    background-color: #4CAF50; /* Green background */
    color: #fff; /* White text color */
    border: none;
    padding: 8px 16px;
    cursor: pointer;
    border-radius: 5px;
}

.body_location button:hover {
    background-color: #45a049; /* Darker green on hover */
}

        </style>
</head>

<body>

    <?php 
    $sql = "SELECT * FROM event WHERE event_id = 'E005'";
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

    <div class="body_location">
        <button onclick="location.href='event_list.php'" title="Back to Event List" class="hide-print"><i class="fa-solid fa-circle-left"></i> Back</button>

        <h1><u><?php echo $name ?></u></h1>

        <div>
            <h2>Account Details:</h2>
            <p>Time : <?php echo date("Y-m-d h:i:s"); ?></p>
            <p>Current ID : <?php echo $member_id ?></p>
            <p>Name : <?php echo $member_name ?></p>
            <p>Contact : <br>(Phone) <?php echo $member_phone ?> <br>(Email) <?php echo $member_email ?> </p>
            <p>Address : <?php echo $member_address ?></p>

            <button onclick="location.href='user_account_details.php'" title="Edit Details" class="hide-print">Edit Details</button>
        </div>

        <?php

        $sql_show_gift = "SELECT * from gift";
        $sum = 0;

        $result = mysqli_query($combine_data, $sql_show_gift);
        if($result && mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['gift_id'];
                $name = $row['gift_name'];
                $point = $row['gift_point'] ;
                $description = $row['description'];
                $stock = $row['gift_stock'];
                $picture = 'UPLOAD/Gift/' . $id . '.jpg';
                $cacheBuster = time();
                $pictureUrl = $picture . '?t=' . $cacheBuster;
                if(isset($picture) && file_exists($picture)) {
                    $pictureUrl = "<img src='$pictureUrl' id='picture_gift' alt='Gift Picture' />";
                } else {
                    $pictureUrl =  "<img src='UPLOAD/Gift/no_gift_picture.png' id='picture_gift' alt='Gift Picture' />";
                }

                if($stock > 0){
                    echo "<div>
                        $pictureUrl
                        <h2>Gift Name : $name</h2>
                        <p>Point Needed : $point</p>
                        <p>$description</p>
                        <p>Stock : $stock</p>
                        <button onclick=\"location.href='gift_exchange_process.php?gift_id=$id&point=$point'\">Click To Exchange!</button>
                    </div><br>";
                    $sum++;
                }
            }

            if($sum == 0){
                echo "<div>No Gift Record.</div>";
            }
        } else {
            echo "<div>No events found.</div>";
        }

        ?>

    </div>
</body>

<?php
    include('footer.php');
?>