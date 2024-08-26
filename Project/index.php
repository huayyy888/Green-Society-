<?php
    session_start();
    include('header.php');
?>

<head>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<div class="body_position">
    <br>
    <div class="blackspace">
        <div class="slide_size">
            <!-- Slide -->
            <div class="slide_table">

                <div class="slide_page slide_animation">
                    <div class="slide_image">
                        <img src="PIC/Index/earth_hour.png" alt="Earth Hours">
                    </div>
                </div>

                <div class="slide_page slide_animation">
                    <div class="slide_image">
                        <img src="PIC/Index/exchange_point.png" alt="Exchange Point To Get GIft">
                    </div>
                </div>

                <div class="slide_page slide_animation">
                    <div class="slide_image">
                        <img src="PIC/Index/paper_recycled.png" alt="Paper Recycled From Our Website">
                    </div>
                </div>

                <a onclick="slide_page(-1)" class="slide_prev">❮</a>
                <a onclick="slide_page(1)" class="slide_next">❯</a>

            </div>

        </div>

        <div class="reset_location"><br></div>

        <div class="video_location">
            <video class="video_size" muted loop autoplay>
                <source src="VIDEO/Green.mp4" type="video/mp4">
                <source src="VIDEO/Green.ogg" type="video/ogg">
                Your browser not support the video.
            </video>
        </div>

    </div>
    
    <script>
        let slideIndex = 1;
        var time;
        showSlides(slideIndex);

        function slide_page(n) {
            clearTimeout(time);
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide_page");

            if (n == undefined) {
                    n = ++slideIndex;
            }

            if (n > slides.length) {
                slideIndex = 1;
            }    
            
            if (n < 1) {
                slideIndex = slides.length;
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }

            slides[slideIndex-1].style.display = "block"; 
            
            time = setTimeout(showSlides, 2000); 
        }
    </script>
    <br>

    <!-- Select Item? -->
    <div class="item_select">
        <ul>
            <li><img src="PIC/Index/1.jpg" alt="Earth Day 2024"></li>
            <li><h3><u>Earth Day 2025</u></h3></li>
            <li>
                <p>Hosted on April 22, 2025,</p>
                <p>Create a poster using Canva!</p>
                <p>Winner can get extra points.</p>
            </li>
            <li><button onclick="location.href='event_details.php?event_id=E001';" title="Click to Know More!">&#9755;Details</button></li>
        </ul>

        <!---->

        <ul>
            <li><img src="PIC/Index/2.jpg" alt="Recycle Menu Update"></li>
            <li><h3><u>Recycle Menu Update</u></h3></li>
            <li>
                <p>Recycle Menu Updated!!!</p>
                <p>Click Item List to check more.</p>
                <br>
            </li>
            <li><button onclick="location.href='item_list.php';" title="Click to Know More!">&#9755;Details</button></li>
        </ul>

        <!---->

        <ul>
            <li><img src="PIC/Index/3.jpg" alt="Temporary Online Recycle"></li>
            <li><h3><u>Temporary Online Recycle</u></h3></li>
            <li>
                <p>Online Recycle is available for now!</p>
                <p>Click Event List to check more.</p>
                <br>
            </li>
            <li><button onclick="location.href='event_details.php?event_id=E003';" title="Click to Know More!">&#9755;Details</button></li>
        </ul>

        <!---->

        <ul>
            <li><img src="PIC/Index/4.jpg" alt="Clothes Donation"></li>
            <li><h3><u>Clothes Donation</u></h3></li>
            <li>
                <p>Giving A Helping Hand.</p>
                <p>Donate your old clothes that are still in good condition.</p>
                
            </li>
            <li><button onclick="location.href='event_details.php?event_id=E004';" title="Click to Know More!">&#9755;Details</button></li>
        </ul>

        <!---->

        <ul>
            <li><img src="PIC/Index/5.jpg" alt="Point Exchange"></li>
            <li><h3><u>Point Exchange</u></h3></li>
            <li>
                <p>Point Exchange is available for now!</p>
                <p>Using points to exchange the gift.</p>
                <br>
            </li>
            <li><button onclick="location.href='event_details.php?event_id=E005';" title="Click to Know More!">&#9755;Details</button></li>
        </ul>
        <ul class="show_more">
            <li onclick="location.href='event_list.php';"><h1>Show More >></h1></li>
        </ul>
    </div>
</div>
<br>
<?php
    include('footer.php');
?>

