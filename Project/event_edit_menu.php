<?php
    session_start();
    include('admin_check.php');
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="">
</head>

<!-- Read Data -->
<?php
    if(isset($_GET['event_id'])) {
        // Get the event_id from the URL
        $event_id = $_GET['event_id'];

        // Fetch user details based on event_id
        $sql = "SELECT * FROM event WHERE event_id = '$event_id'";
        $result = mysqli_query($combine_data, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $id = $row['event_id'];
            $name = $row['event_name'];
            $type = $row['event_type'] ;
            $description = $row['event_description'];
            $location = $row['event_location'];
            $date = $row['event_date'];
            $join = $row['event_join_type'];
            $fix = $row['fix'];
        }
    } else {
        echo "<p>No event ID provided.</p>";
        echo "<script>location.href='admin_event_manage.php'</script>";
    }
?>

<body>
    <div class="body_loaction">

    <button onclick="location.href='admin_event_manage.php'" title="Back to Event Check"><i class="fa-solid fa-circle-left"></i> Back</button>

    <br>
    <h2><u>Edit Event Details</u></h2>

        <!-- User Information -->
        <script>
                function resetValue(input_name, originalValue) {
                    document.getElementById(input_name).value = originalValue;
                }

                function resetType(input_name, originalValue) {
                    // Loop through radio buttons to find the one with the matching value
                    var radios = document.getElementsByName(input_name);
                    for (var i = 0; i < radios.length; i++) {
                        if (radios[i].value === originalValue) {
                            // Set the checked attribute of the matching radio button
                            radios[i].checked = true;
                            break;
                        }
                    }
                }
            </script>     


        <form class="form_admin_edit_user" action='event_edit_process.php?event_id=<?php echo $id ?>' method='POST' enctype="multipart/form-data">


            <p>Original ID : <b><?php echo $id ?></b></p>   

            <?php if($fix == 1){
            ?>
                <label for="id_new">ID : <?php echo $id ?></label>
                <input type='hidden' maxlength='12' name='id_new' id='id_new' value='<?php echo $id ?>' required>
            <?php
            }else{
                ?> 
                
                <label for="id_new">ID : </label>
                <input type='text' maxlength='12' name='id_new' id='id_new' value='<?php echo $id ?>' required>
                <button type="button" onclick="resetValue('id_new', '<?php echo $id ?>')"><i class="fa-solid fa-rotate"></i></button>
                
                <?php
            } ?>
            

            <br><br>

            <label for="name">Name : </label>
            <input type='text' maxlength='60' name='name' id='name' value='<?php echo $name ?>' required>
            <button type="button" onclick="resetValue('name', '<?php echo $name ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label id="type_select">Event Type : </label>
            <input type="radio" id="online" name="type_select" value="2" <?php if($type == '2') echo 'checked'; ?> required>
            <label for="online">Online</label>
            <input type="radio" id="offline" name="type_select" value="1" <?php if($type == '1') echo 'checked'; ?>>
            <label for="offline">Offline</label>
            <input type="radio" id="system" name="type_select" value="3" <?php if($type == '3') echo 'checked'; ?>>
            <label for="system">System Update</label>
            <button type="button" onclick="resetType('type_select', '<?php echo $type ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <?php
            if($join != 3){
                ?>

                <label id="type_select">Join Type : </label>
                <input type="radio" id="click_button" name="join_type" value="1" <?php if($join == '1') echo 'checked'; ?>>
                <label for="click_button">Click Button</label>
                <input type="radio" id="upload_file" name="join_type" value="2" <?php if($join == '2') echo 'checked'; ?>>
                <label for="system_update">System</label>
                <button type="button" onclick="resetType('join_type', '<?php echo $join ?>')"><i class="fa-solid fa-rotate"></i></button>

                <?php
            }else{
                ?>

                <label id="type_select">Join Type : </label>
                <input type="radio" id="fix" name="join_type" value="3" <?php if($join == '3') echo 'checked'; ?>>
                <label for="fix">Special : Have Own Page</label>

                <?php
            }
            ?>

            <br><br>
            
            <label for="date">Date : </label>
            <input type='date' maxlength='60' name='date' id='date' value='<?php echo $date ?>'>
            <button type="button" onclick="resetValue('date', '<?php echo $date ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="location" class="location_label">Location : </label>
            <textarea maxlength='200' name='location' id='location' rows='10' cols='60' style='max-width: 616px;'><?php echo $location ?></textarea>
            <button type="button" onclick="resetValue('location', '<?php echo $location ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>

            <label for="description" class="description_label">Description : </label>
            <textarea maxlength='200' name='description' id='description' rows='10' cols='60' style='max-width: 616px;' required><?php echo $description ?></textarea>
            <button type="button" onclick="resetValue('description', '<?php echo $description ?>')"><i class="fa-solid fa-rotate"></i></button>

            <br><br>
            
            <button type="submit">Submit</button>
            <button type="button" onclick="
                resetValue('location', '<?php echo $location ?>')
                resetValue('id_new', '<?php echo $id ?>');
                resetValue('name', '<?php echo $name ?>');
                resetValue('date', '<?php echo $date ?>')
                resetValue('description', '<?php echo $description ?>');
                resetType('type_select', '<?php echo $type ?>');
                resetType('join_type', '<?php echo $join ?>');
            ">Reset All</i></button>
        </form>

    </div>
        
    
</body>

<?php
    include('footer.php');
?>
