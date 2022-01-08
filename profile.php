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
	<div class="profile">
	<div class="profile-container">
        <h2 class="co-title">My Profile</h2>

        <div class="profile-small-container">
        <?php
			$q=mysqli_query($db,"SELECT * FROM student where studentid='$_SESSION[studentid]';");
				
			$row=mysqli_fetch_assoc($q);
            echo "<div class='select-img'>
                 <a href='images/".$_SESSION['pic']."'><img class='profile-page-img' src='images/".$_SESSION['pic']."'></a>
				 <form method='post' enctype='multipart/form-data'>
					<label id='select-profile'><i class='fas fa-camera'></i>
					<input type='file' name='file' required>
					</label>
				 	<button type='submit' name='profileimg'>Update Profile Picture</button>
				 </form>  
            </div>";
			
				echo "<b>";
				echo "<table class='profile-table table-bordered'>";
				echo "<tr>"; 
				echo "<td>";
					echo "<b> Student ID:  </b>";
				echo "</td>";
				echo "<td>";
					echo $row['studentid'];
				echo "</td>";
				echo "</tr>";

                echo "<tr>";
				echo "<td>";
					echo "<b> User Name:  </b>";
				echo "</td>";
				echo "<td>";
					echo $row['student_username'];
				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>";
					echo "<b> Full Name:  </b>";
				echo "</td>";
				echo "<td>";
					echo $row['FullName'];
				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>";
					echo "<b> Email:  </b>";
				echo "</td>";
				echo "<td>";
					echo $row['Email'];
				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>";
					echo "<b> Password:  </b>";
				echo "</td>";
				echo "<td>";
					echo $row['Password'];
				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>";
					echo "<b> Phone Number:  </b>";
				echo "</td>";
				echo "<td>";
					echo $row['PhoneNumber'];
				echo "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "</table>";
				echo "<td>";?><a href="edit_profile.php?ed=<?php echo $row['studentid'];?>"><button type="submit" name="submit1" class="btn btn-default"><b>Edit</b>
			    </button>
		    </a>
		    <?php
	            echo "</td>";
				echo "</tr>";
	
				echo "</b>";
            ?>
        </div>
        
    </div>
	</div>
	<?php
		if(isset($_POST['profileimg']))
		{
            move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
            $pic = $_FILES['file']['name'];
            $_SESSION['pic'] = $pic;
			$q1="UPDATE student SET studentpic='$pic'
			where  studentid='".$_SESSION['studentid']."';";
			if(mysqli_query($db,$q1))
            {
                ?>
                <script type="text/javascript">
                    alert("Profile picture is updated successfully.");
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