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
    <title>Online Library Management System</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <div class="banner">
        <div class="form">
            <div class="form-container">
                <div class="form-btn">
                    <span onclick="login()">Login</span>
                    <span onclick="reg()">Register</span>
                    <hr id="indicator">
                </div>
                <form action="" id="loginform" method="post">
                    <input type="text" placeholder="User Name" name="student_username" required>
                    <input type="email" placeholder="Email" name="Email" required>
                    <input type="password" placeholder="Password" name="Password" id="Pass" required>
                    <span class='show-hide'><i class="fas fa-eye" id="eye"></i></span>
                    <button type="submit" class="btn" name="login" style="margin-top:-10px;">Login</button>
                    <a href="student_forgot_password.php">Forgot Password?</a>
                    <div class="signup">
                        <p>New to this website?</p><span onclick="reg()">SignUp</span>
                    </div>
                </form>
                <form action="" id="regform" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="User Name" name="student_username" required>
                    <input type="text" placeholder="Full Name" name="FullName" required>
                    <input type="email" placeholder="Email" name="Email" required>
                    <input type="password" placeholder="Password" name="Password" id="Pass-reg" style="margin-bottom: 0;" required>
                    <span class='show-hide-reg'><i class="fas fa-eye" id="eye-reg"></i></span>
                    <input type="text" name="PhoneNumber" placeholder="Phone Number" style="margin-top:-15px;" required>
                    <div class="label">
                        <label for="pic">Upload Picture :</label>
                    </div>
                    <input type="file"  name="file" class="file" value="">
                    <!-- <div class="label">
                        <label for="pic">Upload your profile picture : </label><br>
                    </div>
                    <input type="file" name="pic" class="file"> -->
                    <button type="submit" class="btn" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>

    <?php

		if(isset($_POST['login']))
		{
			$res=mysqli_query($db,"SELECT * FROM `student` WHERE student_username='$_POST[student_username]' AND Email='$_POST[Email]' AND password='$_POST[Password]';");
			$count=mysqli_num_rows($res);
			$row=mysqli_fetch_assoc($res);
			if($count==0)
			{
				?>
				<script type="text/javascript">
					alert("The username or password doesn't match.");

				</script>
				<?php
			}
			else
			{
				$_SESSION['login_student_username'] = $_POST['student_username'];
				$_SESSION['studentid'] = $row['studentid'];
                $_SESSION['pic'] = $row['studentpic'];

				?>
				<script type="text/javascript">
					window.location="student_dashboard.php";
				</script>

				<?php

			}
		}
	?>
    <?php

    if(isset($_POST['register']) && !empty($_FILES["file"]["name"]))
    {

        $count=0;
        $sql="SELECT * from student";
        $res=mysqli_query($db,$sql);
        

        while($row=mysqli_fetch_assoc($res))
        {
            if($row['student_username']==$_POST['student_username'])
            {
                $count=$count+1;
            }
        }
        if($count==0)
        {
            move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
            $pic = $_FILES['file']['name'];
            mysqli_query($db,"INSERT INTO `STUDENT` VALUES('','$_POST[student_username]','$_POST[FullName]','$_POST[Email]','$_POST[Password]','$_POST[PhoneNumber]','$pic');");

            ?>
                <script type="text/javascript">
                alert("Registration successful ");
                </script>
            <?php		
        }
        else
        {
            ?>
                <script type="text/javascript">
                alert("This username is already registered.");
                </script>
            <?php
        }
    }
    else if(isset($_POST['register']))
    {

        $count=0;
        $sql="SELECT * from student";
        $res=mysqli_query($db,$sql);

        while($row=mysqli_fetch_assoc($res))
        {
            if($row['student_username']==$_POST['student_username'])
            {
                $count=$count+1;
            }
        }
        if($count==0)
        {
        mysqli_query($db,"INSERT INTO `STUDENT` VALUES('','$_POST[student_username]','$_POST[FullName]','$_POST[Email]','$_POST[Password]','$_POST[PhoneNumber]','user2.png');");

            ?>
                <script type="text/javascript">
                alert("Registration successful ");
                </script>
            <?php		
        }
        else
        {
            ?>
                <script type="text/javascript">
                alert("This username is already registered.");
                </script>
            <?php
        }
    }
    ?>


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
            <p>&copy; 2021 Copyright by Our Team</p>
        </div>
    </div>

    <script>
        var LoginForm = document.getElementById("loginform");
        var regform = document.getElementById("regform");
        var indicator = document.getElementById("indicator");
        
        function reg(){
            regform.style.transform = "translateX(-365px)";
            LoginForm.style.transform = "translateX(-400px)";
            indicator.style.transform = "translateX(150px)";
        }
        function login(){
            regform.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            indicator.style.transform = "translateX(0px)";
        }
    
    </script>
    <script>
        var pass = document.getElementById("Pass");
        var showbtn = document.getElementById("eye");
        showbtn.addEventListener("click",function(){
            if(pass.type === "password"){
                pass.type = "text";
                showbtn.classList.add("hide");
            }
            else{
                pass.type = "password";
                showbtn.classList.remove("hide");
            }
        });
    </script>
    <script>
        var pass2 = document.getElementById("Pass-reg");
        var showbtn2 = document.getElementById("eye-reg");
        showbtn2.addEventListener("click",function(){
            if(pass2.type === "password"){
                pass2.type = "text";
                showbtn2.classList.add("hide");
            }
            else{
                pass2.type = "password";
                showbtn2.classList.remove("hide");
            }
        });
    </script>
</body>
</html>