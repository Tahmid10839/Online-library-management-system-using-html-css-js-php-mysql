<?php

	include "connection.php";
    include "admin_navbar.php";
    $res1=mysqli_query($db,"SELECT * FROM authors");
	$res2=mysqli_query($db,"SELECT * FROM category");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="edit-profile-container">
        <?php
			
			$studentid=$_GET['ed'];
			$bookid=$_GET['ed1'];

			$q= "SELECT student.studentid,FullName,studentpic,issueinfo.bookid,books.bookname,ISBN,price,bookpic,issuedate,returndate,approve,authors.authorname,category.categoryname From issueinfo inner join student on issueinfo.studentid=student.studentid inner join books on issueinfo.bookid=books.bookid join authors on authors.authorid=books.authorid join category on category.categoryid=books.categoryid where student.studentid=$studentid and approve='' and issueinfo.bookid=$bookid";
			$res=mysqli_query($db,$q) or die(mysqli_error());
			
			$row=mysqli_fetch_assoc($res);
			
				$studentid=$row['studentid'];
				$studentpic=$row['studentpic'];
				$FullName=$row['FullName'];
				$bookid=$row['bookid'];
				$bookpic=$row['bookpic'];
				$bookname=$row['bookname'];
				$authorname=$row['authorname'];
				$categoryname=$row['categoryname'];
				$ISBN=$row['ISBN'];
				$price=$row['price'];
	    ?>
        <div class="form form-book">
            <div class="form-container edit-form-container issue-book-container edit-book-container">
                <div class="form-btn">
                    <span onclick="login()" style="width: 100%;">Issue Book</span>
                    <hr id="indicator" class="add-author">
                </div>
                <form action="" id="loginform" method="post" enctype="multipart/form-data">
                    <div class="label">
                        <?php echo "<img width='50px' height='50px' src='images/".$studentpic."'>"?>
                    </div>
                    <div class="label">
                        <label for="studentid">Student ID : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $studentid;
			            ?>
                    </b><br>
                    </div> 
                    <div class="label">
                        <label for="studentid">Full Name : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $FullName;
			            ?>
                    </b><br>
                    </div> 
                    <div class="label" style="margin-top: 10px;">
                        <?php echo "<img width='50px' height='50px' src='images/".$bookpic."'>"?>
                    </div>
                    <div class="label">
                        <label for="studentid">Book ID : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $bookid;
			            ?>
                    </b><br>
                    </div> 
                    <div class="label">
                        <label for="studentid">Book Name : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $bookname;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">Author Name : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $authorname;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">Category Name : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $categoryname;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">ISBN : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $ISBN;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">Price : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $price;
			            ?>
                    </b><br>
                    </div>
                    <input type="text"  name="approve" placeholder="Approve">
                    <div class="label">
                        <label for="status">Issue Date : </label>
                    </div>
                    <input type="date"  name="issuedate">
                    <div class="label">
                        <label for="status">Return Date : </label>
                    </div>
                    <input type="date"  name="returndate">
                    <div class="label">
                        <label for="status">Return Date with time : </label>
                    </div>
                    <input type="datetime-local"  name="returndatetime">

                    <button type="submit" class="btn" name="submit" style="margin-top: 20px;">Issue</button> 
                </form>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['submit']))
        {
            $dbInsertDate = date('Y-m-d H:i:s', strtotime($_POST['returndatetime']));
            mysqli_query($db,"INSERT into timer VALUES('$studentid','$bookid','$dbInsertDate');");
            $approve=$_POST['approve'];
            $issuedate=$_POST['issuedate'];
            $returndate=$_POST['returndate'];

            $q1="UPDATE issueinfo SET issuedate='$issuedate',returndate='$returndate',approve='$approve' where approve='' and bookid=$bookid and studentid=".$studentid.";";
            if(mysqli_query($db,$q1))
            {
                ?>
                <script type="text/javascript">
                    alert("Book issued successfully.");
                    window.location="request_info.php";
                </script>
                <?php
            }
        }

	?>
    <!-- <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                <h1>Opening Hours</h1>
                <p><i class="far fa-clock"></i>Monday to Friday - 9am to 9pm</p>
                <p><i class="far fa-clock"></i>Saturday to Sunday - 8am to 11pm</p>
            </div>
            <div class="footer-right">
                <h1>Get In Touch</h1>
                <p>#30 abc Colony, xyz City IN<i class="fas fa-map-marker-alt"></i></p>
                <p>example@website.com<i class="fas fa-paper-plane"></i></p>
                <p>+8801515637957<i class="fas fa-phone-alt"></i></p>
            </div>
        </div>
        <div class="social-links">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram-square"></i>
            <i class="fab fa-youtube"></i>
            <p>&copy; 2021 Copyright by Nazre Imam Tahmid</p>
        </div>
    </div> -->
</body>
</html>