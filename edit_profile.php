<?php

	include "connection.php";
    include "student_navbar.php";
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
		$studentid=$_SESSION['studentid'];
		$q= "SELECT * FROM Student where  studentid='$_SESSION[studentid]'";
			$res=mysqli_query($db,$q) or die(mysqli_error());

		while($row=mysqli_fetch_assoc($res))
			{
				
				$student_username=$row['student_username'];
				$FullName=$row['FullName'];
				$Email=$row['Email'];
				$PhoneNumber=$row['PhoneNumber'];

			}
	?>
        <div class="form">
            <div class="form-container edit-form-container">
                <div class="form-btn">
                    <span onclick="login()" style="width: 100%;">Edit Profile</span>
                    <hr id="indicator" class="add-author">
                </div>
                <form action="" id="loginform" method="post" enctype="multipart/form-data">
                    <div class="label">
                        <label for="studentid">Student ID : </label>
                        <b style="font-size: 15px;">
                        <?php
			                echo $studentid;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="student_username">User Name : </label>
                    </div>
                    <input type="text"  name="student_username" value="<?php echo $student_username; ?>">
                    <div class="label">
                        <label for="FullName">Full Name : </label>
                    </div>
                    <input type="text"  name="FullName" value="<?php echo $FullName; ?>">
                    <div class="label">
                        <label for="Email">Email : </label>
                    </div>
                    <input type="email"  name="Email" value="<?php echo $Email; ?>">
                    <div class="label">
                        <label for="PhoneNumber">Phone Number : </label>
                    </div>
                    <input type="text" name="PhoneNumber" value="<?php echo $PhoneNumber; ?>">
                    <button type="submit" class="btn" name="change">Update</button>
                </form>
            </div>
        </div>
    </div>
    <?php
		if(isset($_POST['change']))
		{
        
            $student_username = $_POST['student_username'];
			$FullName=$_POST['FullName'];
			$Email=$_POST['Email'];
			$PhoneNumber=$_POST['PhoneNumber'];
			$_SESSION['login_student_username']=$_POST['student_username'];
			$q1="UPDATE student SET student_username='$student_username',FullName='$FullName',Email='$Email',PhoneNumber='$PhoneNumber'
			where  studentid='".$_SESSION['studentid']."';";
			if(mysqli_query($db,$q1))
            {
                ?>
                <script type="text/javascript">
                    alert("Profile is updated successfully.");
                    window.location="profile.php";
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