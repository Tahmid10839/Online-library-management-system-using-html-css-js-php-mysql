<?php

    include "connection.php";
    include "index_navbar.php";
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="banner">
        <div class="banner-content">
            <h1>Welcome to Library</h1>
        </div>
    </div>
    <div class="trending-books all-books">
        <div class="small-container">
            <h2 class="co-title">Trending Books</h2>
            <div class="row">
            <?php
                $res=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid join trendingbook on trendingbook.bookid=books.bookid;");
                while($row=mysqli_fetch_assoc($res)){
                    ?>
                    <div class="card">
                        <!-- <img src="images/c.jpg" alt="">  -->
                        <?php
                            echo "<img src='images/".$row['bookpic']."'>";
                        ?>
                        <div class="card-body">
                            <h4 style="font-size: 18px;">
                                <?php
                                    echo $row['bookname'];
                                ?></h4>
                                <p style="font-size: 18px">Price: 
                                <?php
                                    echo $row['price'];
                                ?> Tk.</p>
                            
                            <div class="overlay"></div>
                            <div class="sub-card">
                            <p><b>Book Name: &nbsp;</b> 
                            <?php
                                echo $row['bookname'];
                            ?></p>  
                            <p><b>Category Name: &nbsp;</b> 
                            <?php
                                echo $row['categoryname'];
                            ?></p>
                            <p><b>Author Name: &nbsp;</b> 
                            <?php
                                echo $row['authorname'];
                            ?></p>
                            <p><b>ISBN: &nbsp;</b> 
                            <?php
                                echo $row['ISBN'];
                            ?></p>
                            <p><b>Quantity: &nbsp;</b> 
                            <?php
                                echo $row['quantity'];
                            ?></p>
                            <p><b>Price:</b> 
                            <?php
                                echo $row['price'];
                            ?> Tk.</p> 
                            <p><b>Status: &nbsp;</b>
                            <span>
                            <?php
                                echo $row['status'];
                            ?></span> </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- <div class="card">
                    <img src="images/c.jpg" alt=""> 
                    <div class="card-body">
                        <h4>C</h4>
                        <p>$50.00</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/cplus.jpg" alt="">
                    <div class="card-body">
                        <h4>C++</h4>
                        <p>$50.00</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/java.jpg" alt="" class="java-img">
                    <div class="card-body">
                        <h4>Java</h4>
                        <p>$50.00</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/python2.jpg" alt="">
                    <div class="card-body">
                        <h4>Python</h4>
                        <p>$50.00</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="testimonial">
        <div class="small-container">
        <h2 class="co-title">Testimonial</h2>
            <div class="row">
            <?php
            $res=mysqli_query($db,"SELECT student.studentpic,FullName,feedback.rating,comment from feedback join student on student.studentid=feedback.stdid ORDER BY feedback.rating DESC");
            $total = mysqli_num_rows($res);
            $count=0;
            while($count<3 && $row=mysqli_fetch_assoc($res)){
                ?>
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p><?php
                        echo $row['comment'];
                    ?></p>
                    <?php
                        ?>
                        <div class="rating"><?php
                        if($row['rating']==5){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==4){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==3){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==2){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==1){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }?>
                        </div>
                    <?php
                        echo "<img src='images/".$row['studentpic']."'>";
                    ?>
                    <?php
                        echo "<h3>";echo $row['FullName'];echo"</h3>";
                    ?>
                </div>
                <?php
                $count = $count+1;
            }
            ?>
                
                <!-- <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        Lorem Ipsim is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever.
                     </p>
                     <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <img src="images/user-1.png" alt="">
                    <h3>Sean Parker</h3>
                </div> -->
                <!-- <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        Lorem Ipsim is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever.
                     </p>
                     <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <img src="images/user-2.png" alt="">
                    <h3>Mike Smith</h3>
                </div>
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        Lorem Ipsim is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever.
                     </p>
                     <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <img src="images/user-3.png" alt="">
                    <h3>Mabel Joe</h3>
                </div> -->
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                <h1>Opening Hours</h1>
                <p><i class="far fa-clock"></i>Monday to Friday - 9am to 9pm</p>
                <p><i class="far fa-clock"></i>Saturday to Sunday - 8am to 11pm</p>
            </div>
            <div class="footer-middle">
                <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14603.750746881911!2d90.34330166977537!3d23.785233199999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c094bd84832f%3A0xac81089e47ea5cdd!2sBangla%20College%20Central%20Library!5e0!3m2!1sen!2sbd!4v1615122444874!5m2!1sen!2sbd" width="600" height="200" style="border:0;" allowfullscreen="" loading="lazy" aria-hidden="false"></iframe>
            </div>
            <div class="footer-right">
                <h1>Get In Touch</h1>
                <p>Bangla College Central Library, Dhaka<i class="fas fa-map-marker-alt"></i></p>
                <p>example@website.com<i class="fas fa-paper-plane"></i></p>
                <p>+8801515637957<i class="fas fa-phone-alt"></i></p>
            </div>
        </div>
        <div class="social-links">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram-square"></i>
            <i class="fab fa-youtube"></i>
            <p>&copy; 2021 Copyright by Our Team</p>
        </div>
    </div>
    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>