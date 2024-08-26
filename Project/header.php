<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Default System -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Logo icon -->
    <link rel="icon" href="PIC/logo.png" type="image/png">

    <!-- Title --> 
    <title>Green Society</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="CSS/page.css">

    <!-- Link CSS -->
    <link rel="stylesheet" href="CSS/OnlyUP.css">

    <!-- Link CSS -->
    <link rel="stylesheet" href="CSS/color.css">

    <!-- Link CSS -->
    <link rel="stylesheet" href="CSS/header.css">
    
    <!-- Link CSS -->
    <link rel="stylesheet" href="CSS/footer.css">

    <script src="https://kit.fontawesome.com/d465ab18cb.js" crossorigin="anonymous"></script>
    
    <script src="SCRIPTS/jquery-1.9.1.js"></script>

    <script>
        $(document).ready(function(){
    
            $('#ToolsMenu').click(function()
            {
                $('#ToolsList').slideToggle();
            });

            $('#CloseTools').click(function()
            {
                $('#ToolsList').slideUp();
            });
            
        });     
    </script>

</head>

<?php include('connection.php'); ?>

<body>

    <!-- A button that show and make user up to the top of the website -->
    <button onclick="OnlyUP()" id="OnlyUP" title="Top of Page">&#708;</button>

    <!-- Script for Button UP -->
    <script>
    // button
    let button = document.getElementById("OnlyUP");

    // User to go down, and show button 
    window.onscroll = function() {Down()};

    function Down(){
        // if user scroll website over 20, show button else hide
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
        {
            // show
            button.style.display = "block";
        } else {
            // hide
            button.style.display = "none";
        }
    }

    // When user click
    function OnlyUP() {
        // smooth going up
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
    </script>

    <header>
        <nav 
            <?php 
                if(!empty($_SESSION['account_type']) && $_SESSION['account_type'] == "admin") {
                    echo 'class="admin_header_background"'; 
                }
                elseif (!empty($_SESSION['account_type']) && $_SESSION['account_type'] == "user") {
                    echo 'class="user_header_background"'; 
                }
                else{
                    echo 'class="normal_header_background"';
                }?>>

        <a class="logo_border" title="Back To Index">
            <img src="PIC/logo.png" alt="Logo" class="header_logo" onclick="location.href = 'index.php'">
        </a>
            
            <script>
                var ToolMenuOpen = '0';

                function ToolMenuClick() {
                    if (ToolMenu == "1") {
                        document.getElementById("ToolMenu").style.height = "0";
                        ToolMenu = '0'; 
                    } else {
                        // height header
                        document.getElementById("ToolMenu").style.height = "550px";
                        ToolMenu = '1'; 
                    }
                }              
            </script>



            <ul>
                <li><button class="shadow" onclick="location.href='index.php'">Home</button></li>

                <?php

                    if(!empty($_SESSION['account_type']) and $_SESSION['account_type'] == "admin")
                    {
                        echo " 
                        <li><button class='shadow' id='ToolsMenu'>Tools</button></li>
                        ";
                    }

                    // User Header
                    else if(!empty($_SESSION['account_type']) and $_SESSION['account_type'] == "user")
                    {
                        echo " 
                        <li><button class='shadow' onclick=\"location.href='event_list.php'\">Event</button></li>
                        <li><button class='shadow' id='ToolsMenu'>Tools</button></li>
                        ";
                    }else {
                        echo "<li><button class='shadow' onclick=\"location.href='event_list.php'\">Event</button></li>";
                    }

                ?>

            </ul>
                        
            <!-- Logo -->
                <?php
                    // Admin Logo
                    if(!empty($_SESSION['account_type']) and $_SESSION['account_type'] == "admin")
                    {
                        $nokp = $_SESSION['nokp'];
                        $sql = "SELECT * FROM admin
                                WHERE admin_nokp = '$nokp'";

                        $result = mysqli_query($combine_data, $sql);
                        if($result && mysqli_num_rows($result)){
                            $row = mysqli_fetch_assoc($result);
                            $id = $row['admin_nokp'];
                            $name = $row['admin_name'];
                        } 
                        
                        echo "                     
                        <ul class='account_border'>
                            <li class='account_location'>
                                <button onclick='dropdown();' class='account_btn'>
                                    <i class='fa-solid fa-user-tie'></i>
                                    <p>$name</p>
                                </button>
                            </li>
                        </ul>

                        <div id='Dropdown' class='dropdown-table'>
                            <p>ID : $id
                            <br>NAME: $name
                            </p>
                            <a href='admin_account_details.php'>Account Details</a>
                            <a href='admin_reset_password.php'>Reset Password</a>
                            <a href='logout.php' onclick='return confirm(\"Log Out?\")'>Logout</a>
                        </div>
                        ";
                    }

                    // User Point and Logo
                    else if(!empty($_SESSION['account_type']) and $_SESSION['account_type'] == "user")
                    {
                        $nokp = $_SESSION['nokp'];
                        $sql = "SELECT * FROM member
                                WHERE member_nokp = '$nokp'";

                        $result = mysqli_query($combine_data, $sql);
                        if($result && mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $id = $row['member_nokp'];
                            $name = $row['member_name'];
                            $point = $row['member_point'];
                        } else {
                            $point = 0;
                        }
                        
                        echo " 
                        <ul class='point_border'>
                            <li class='point_location'>
                                <div class='point_text'>
                                    <p>$point</p>
                                    <p>POINTS</p>
                                </div>
                            </li>
                        </ul>
                    
                        <ul class='user_border'>
                            <li class='account_location'>
                                <button onclick='dropdown();' class='account_btn'>
                                    <i class='fa-solid fa-user'></i>
                                    <p>$name</p>
                                </button>
                            </li>
                        </ul>

                        <div id='Dropdown' class='dropdown-table'>
                            <p>ID : $id
                            <br>NAME: $name
                            </p>
                            <a href='user_account_details.php'>Account Details</a>
                            <a href='user_reset_password.php'>Reset Password</a>
                            <a href='logout.php' onclick='return confirm(\"Log Out?\")'>Logout</a>
                        </div>
                        ";
                    }

                    // No Account Logo 
                    else
                    {
                        echo " 
                        <ul class='account_border'>
                            <li class='account_location'>
                                <a href='user_login.php' class='account_btn' title='Click to Login'>
                                    <i class='fa-regular fa-user'></i>
                                    <p>Login</p>
                                </a>
                            </li>
                        </ul>
                        ";
                    }
                ?>
      </nav>

      <?php
        // echo $_SESSION['account_type'];
      ?>
    </header>

    <script>
        let i = 0;
        function dropdown() {
            let dropdown = document.getElementById("Dropdown");
            if (i == 0) {
                dropdown.style.display = "block";
                i = 1;
            } else {
                dropdown.style.display = "none";
                i = 0;
            }
        }
    </script>

    <div class="ToolMenuClass" id="ToolsList">
        <?php
            // Admin Tool Menu
            if(!empty($_SESSION['account_type']) and $_SESSION['account_type'] == "admin")
            {
                echo " 
                <div id='ToolsList'>
                    <button class='close_button' id='CloseTools'><i class='fa-solid fa-circle-xmark'></i></button>
                    <div class='tools_position'>
                        <div class='toolsflex'>
                            <div>
                                <div>Member</div>
                                <div class='History_Tools'>
                                    <button onclick=\"location.href='admin_user_manage.php'\">Member Management</button>
                                </div>
                            </div>

                            <div class='tools_row_line'></div>

                            <div>
                                <div>Item</div>
                                <div class='History_Tools'>
                                    <button onclick=\"location.href='admin_item_manage.php'\">Item Management</button>
                                </div>
                            </div>

                            <div class='tools_row_line'></div>

                            <div>
                                <div>Staff</div>
                                <div class='History_Tools'>
                                    <button onclick=\"location.href='admin_staff_manage.php'\">Staff Management</button>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div>
                            <div>Event</div>
                            <div class='History_Tools'>
                                <button onclick=\"location.href='admin_event_attendance.php'\">Event Attendance</button>
                                <button onclick=\"location.href='admin_event_manage.php'\">Event Management</button>
                            </div>
                        </div>

                        <br>

                        <div>History</div>
                        <div class='History_Tools'>
                            <button onclick=\"location.href='gift_history.php'\">Gift History</button>
                            <button onclick=\"location.href='point_history.php'\">Point History</button>
                            <button onclick=\"location.href='event_history.php'\">Event History</button>
                        </div>
                    </div>
                </div>
                ";
            }

            // User Tool Menu
            else if(!empty($_SESSION['account_type']) and $_SESSION['account_type'] == "user")
            {
                echo " 
                <div id='ToolsList'>
                    <button class='close_button' id='CloseTools'><i class='fa-solid fa-circle-xmark'></i></button>
                    <div class='tools_position'>
                        <div class='toolsflex'>
                        <div>
                            <div>Item</div>
                            <div class='History_Tools'>
                                <button onclick=\"location.href='item_list.php'\">Item List</button>
                            </div>
                        </div>

                        <div class='tools_row_line'></div>

                        <div>
                            <div>Event</div>
                            <div class='History_Tools'>
                                <button onclick=\"location.href='event_list.php'\">Join Event</button>
                            </div>
                        </div>
                        </div>

                        <br>

                        <div>History</div>
                        <div class='History_Tools'>
                            <button onclick=\"location.href='user_gift_history.php'\">Gift History</button>
                            <button onclick=\"location.href='user_event_history.php'\">Event History</button>
                        </div>
                    </div>
                </div>
                ";
            }
        ?>
    </div>    
</body>
</html>