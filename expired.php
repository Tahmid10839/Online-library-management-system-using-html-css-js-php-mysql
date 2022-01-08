<?php

	include "connection.php";
    include "admin_navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="search-bar admin-search">
        <form action="" method='post'>
            <input type="search" name='search' placeholder='Search by Student ID' required>
            <button type='submit' name='submit'><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="request-table">
        <div class="request-container book-container"  style="max-width: 1600px;">
            <h2 class="request-title student-info-title">List of Expired books</h2>
            <?php
        $e=0;
		if(isset($_POST['submit']))
		{
            $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
			$q=mysqli_query($db,"SELECT student.studentid,FullName,studentpic,books.bookid,bookname,ISBN,price,bookpic,authors.authorname,category.categoryname,issueinfo.issuedate,returndate,approve,fine FROM student inner join issueinfo on student.studentid=issueinfo.studentid inner join books on issueinfo.bookid=books.bookid join authors on authors.authorid=books.authorid join category on category.categoryid=books.categoryid where issueinfo.approve='$var' AND issueinfo.studentid='$_POST[search]' ORDER BY `issueinfo`.`returndate` ASC;");
			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! There's no expired book by this student ID";

			}
			else
			{
				echo "<table class='rtable booktable'>";
                echo "<tr style='background-color: teal;'>";
                //Table header
                echo "<th>"; echo "Students"; echo "</th>";
                echo "<th>"; echo "Books"; echo "</th>";
                echo "<th>"; echo "Issue Date"; echo "</th>";
                echo "<th>"; echo "Return Date"; echo "</th>";
                echo "<th>"; echo "Approve Status"; echo "</th>";
                echo "<th style='padding-left: 0;'>"; echo "Fine"; echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($q))
                {
                    $d = strtotime($row['returndate']);
                    $c=strtotime(date("Y-m-d"));
                    $diff = $c-$d;
                    if($diff>0){
                        $day = floor($diff/(60*60*24));
                        $e=$e+1;
                        $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
                        $fine = $day*10;
                        mysqli_query($db,"UPDATE issueinfo SET approve='$var',fine=$fine where `returndate`='$row[returndate]' and approve='yes' limit $e;");
                    }
                    echo "<tr>";
                    // echo "<td>"; echo $row['studentid']; echo "</td>";
                    // echo "<td>"; echo $row['FullName']; echo "</td>";
                    echo "<td>
                    <div class='table-info'>
                        <img src='images/".$row['studentpic']."'>
                        <div>
                            <p>Student ID: ";echo $row['studentid'];echo"</p>
                            <p>";echo $row['FullName'];echo"</p><br>";?>
                        </div>
                    </div>
                    </td><?php
                    echo "<td>
                    <div class='table-info'>
                        <img src='images/".$row['bookpic']."'>
                        <div>
                            <p>Book ID: ";echo $row['bookid'];echo"</p>
                            <p>";echo $row['bookname'];echo"</p><br>";?>
                        </div>
                    </div>
                    </td><?php
                    echo "<td>"; echo $row['issuedate']; echo "</td>";
                    echo "<td>"; echo $row['returndate']; echo "</td>";
                    echo "<td>"; echo $row['approve']; echo "</td>";
                    echo "<td>"; echo $row['fine']; echo " Tk."; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
		    }
		}
			//if button is not pressed
		else
		{
			$var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
			$res=mysqli_query($db,"SELECT student.studentid,FullName,studentpic,books.bookid,bookname,ISBN,price,bookpic,authors.authorname,category.categoryname,issueinfo.issuedate,returndate,approve,fine FROM student inner join issueinfo on student.studentid=issueinfo.studentid inner join books on issueinfo.bookid=books.bookid join authors on authors.authorid=books.authorid join category on category.categoryid=books.categoryid where issueinfo.approve='$var' ORDER BY `issueinfo`.`returndate` ASC;");
            if(mysqli_num_rows($res)==0)
			{
				echo "There's no expired books.";
			}
            else{
                echo "<table class='rtable booktable'>";
            echo "<tr style='background-color: teal;'>";
            //Table header
            echo "<th>"; echo "Students"; echo "</th>";
            echo "<th>"; echo "Books"; echo "</th>";
            echo "<th>"; echo "Issue Date"; echo "</th>";
            echo "<th>"; echo "Return Date"; echo "</th>";
            echo "<th>"; echo "Approve Status"; echo "</th>";
            echo "<th style='padding-left: 0;'>"; echo "Fine"; echo "</th>";
            echo "</tr>";

            while($row=mysqli_fetch_assoc($res))
            {
                $d = strtotime($row['returndate']);
                $c=strtotime(date("Y-m-d"));
                $diff = $c-$d;
                if($diff>0){
                    $day = floor($diff/(60*60*24));
                    $e=$e+1;
                    $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
                    $fine = $day*10;
                    mysqli_query($db,"UPDATE issueinfo SET approve='$var',fine=$fine where `returndate`='$row[returndate]' and approve='yes' limit $e;");
                }
                echo "<tr>";
                    // echo "<td>"; echo $row['studentid']; echo "</td>";
                    // echo "<td>"; echo $row['FullName']; echo "</td>";
                    echo "<td>
                    <div class='table-info'>
                        <img src='images/".$row['studentpic']."'>
                        <div>
                            <p>Student ID: ";echo $row['studentid'];echo"</p>
                            <p>";echo $row['FullName'];echo"</p><br>";?>
                        </div>
                    </div>
                    </td><?php
                    echo "<td>
                    <div class='table-info'>
                        <img src='images/".$row['bookpic']."'>
                        <div>
                            <p>Book ID: ";echo $row['bookid'];echo"</p>
                            <p>";echo $row['bookname'];echo"</p>";?>
                        </div>
                    </div>
                    </td><?php
                    echo "<td>"; echo $row['issuedate']; echo "</td>";
                    echo "<td>"; echo $row['returndate']; echo "</td>";
                    echo "<td>"; echo $row['approve']; echo "</td>";
                    echo "<td>"; echo $row['fine']; echo " Tk."; echo "</td>";
                    echo "</tr>";
            }
            echo "</table>";
            }
        }
        ?> 
        </div>
    </div>
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