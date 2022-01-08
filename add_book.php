<?php

	include "connection.php";
    include "admin_navbar.php";
    $res=mysqli_query($db,"SELECT * FROM category");
	$res1=mysqli_query($db,"SELECT * FROM authors");
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
        <div class="form">
            <div class="form-container edit-form-container add-book-form">
                <div class="form-btn">
                    <span onclick="login()" style="width: 100%;">Add Book</span>
                    <hr id="indicator" class="add-author">
                </div>
                <form action="" id="loginform" method="post" enctype='multipart/form-data'>
                    <input type="text" placeholder="Book Name" name="bookname" required>
                    <select class="form-control" name="author" required="">
                        <option value="">Select Author</option>
                        <?php while($row1=mysqli_fetch_array($res1)):;?>
                            <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
                        <?php endwhile;?>
                    </select><br>
                    <select class="form-control" name="category" required="">
                        <option value="">Select Category</option>
                        <?php while($row=mysqli_fetch_array($res)):;?>
                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                        <?php endwhile;?>
                    </select><br>
                    <input type="text" placeholder="ISBN" name="ISBN" required>
                    <input type="text" placeholder="Price" name="price" required>
                    <input type="text" placeholder="Quantity" name="quantity" required>
                    <input type="text" placeholder="Status" name="status" required><br>
                    <div class="label">
                        <label for="pic">Upload picture of the book : </label>
                    </div>
                    <input type="file" name="file" class="file" required>
                    <button type="submit" class="btn" name="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
    <?php
		if(isset($_POST['submit']))
		{
            move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
            $pic = $_FILES['file']['name'];
			mysqli_query($db,"INSERT INTO books VALUES('','$pic','$_POST[bookname]','$_POST[author]','$_POST[category]','$_POST[ISBN]','$_POST[price]','$_POST[quantity]','$_POST[status]') ;");
			?>
			<script type="text/javascript">
				
				alert("Book added successfully.");
			</script>
			<?php
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