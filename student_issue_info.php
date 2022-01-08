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
    <div class="request-table">
        <div class="request-container book-container">
            <h2 class="request-title student-info-title" style="padding-top: 50px;">List of Issued Books</h2>
            <?php
        $e=0;
	    if(isset($_SESSION['login_student_username']))
		{

			$q1=mysqli_query($db,"SELECT studentid from student where studentid='$_SESSION[studentid]';");
		    $row=mysqli_fetch_assoc($q1);

		    $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
			$q=mysqli_query($db,"SELECT books.bookid,books.bookname,books.ISBN,books.bookpic,price,issueinfo.issuedate,issueinfo.returndate,
			issueinfo.approve,fine,authors.authorname,category.categoryname from  `issueinfo` join `books` on issueinfo.bookid=books.bookid join `student`on student.studentid=issueinfo.studentid join authors on authors.authorid=books.authorid join category on category.categoryid=books.categoryid where student.studentid ='$_SESSION[studentid]' and (issueinfo.approve='yes' or issueinfo.approve='$var') ORDER BY `issueinfo`.`returndate` ASC; ");
			if(mysqli_num_rows($q)==0)
			{
				
				echo "There's no issued books";
				
			}
			else
			{
				$var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
				$row1=mysqli_query($db,"SELECT sum(fine),student.studentid,FullName from issueinfo join student on student.studentid=issueinfo.studentid where student.studentid ='$_SESSION[studentid]' and issueinfo.approve='$var';");
                $res1=mysqli_fetch_assoc($row1);
                if(mysqli_num_rows($row1)!=0)
                {
                    ?>
                    <h2 style="padding-left: 1050px;">Your Fine is: &nbsp;<?php echo $res1['sum(fine)'] . " Tk.";?></h2>
                    <?php
                    
                }
                
				echo "<table class='rtable'>";
                echo "<tr style='background-color: teal;'>";
                //Table header
                // echo "<th>"; echo "Book ID"; echo "</th>";
                echo "<th>"; echo "Books"; echo "</th>";
                echo "<th>"; echo "Author Name"; echo "</th>";
                echo "<th>"; echo "Category Name"; echo "</th>";
                echo "<th>"; echo "ISBN"; echo "</th>";
                echo "<th>"; echo "Issue Date"; echo "</th>";
                echo "<th>"; echo "Return Date"; echo "</th>";
                echo "<th>"; echo "Approve Status"; echo "</th>";
                echo "<th>"; echo "Fine"; echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($q))
                {
                    $d = strtotime($row['returndate']);
                    $c=strtotime(date("Y-m-d"));
                    $diff = $c - $d;
                    // if($d > $row['returndate'])
                    // {
                    //     $e=$e+1;
                    //     $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
                    //     mysqli_query($db,"UPDATE issueinfo SET approve='$var',fine=10 where `returndate`='$row[returndate]' and approve='yes' limit $e;");
                    // }
                    if($diff>0){
                        $day = floor($diff/(60*60*24));
                        $e=$e+1;
                        $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
                        $fine = $day*10;
                        mysqli_query($db,"UPDATE issueinfo SET approve='$var',fine=$fine where `returndate`='$row[returndate]' and approve='yes' limit $e;");
                    }
                    // $t=mysqli_query($db,"SELECT * FROM timer where stdid='$_SESSION[studentid]' and bid='$row[bookid]';");
                    // $res = mysqli_fetch_assoc($t);
                    // $countDownDate = strtotime($res['date']);
                    // $now = strtotime(date("Y-m-d H:i:s"));
                    // $diff = $now-$countDownDate;
                    
                    // if($diff>0){
                    //     $day = floor($diff/(1000*60*60*24));
                    //     echo $day;
                    //     $e=$e+1;
                    //     $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
                    //     $fine = $day*10;
                    //     mysqli_query($db,"UPDATE issueinfo SET approve='$var',fine=$fine where `returndate`='$row[returndate]' and approve='yes' limit $e;");
                        
                    // }
                    
                    echo "<tr>";
                    // echo "<td>"; echo $row['bookid']; echo "</td>";
                    echo "<td>
                    <div class='table-info'>
                        <img src='images/".$row['bookpic']."'>
                        <div>
                            <p>";echo $row['bookname'];echo"</p>
                            <small>Price: ";echo $row['price'];echo" Tk.</small><br>";?>
                        </div>
                    </div>
                    </td><?php
                    echo "<td>"; echo $row['authorname']; echo "</td>";
                    echo "<td>"; echo $row['categoryname']; echo "</td>";
                    echo "<td>"; echo $row['ISBN']; echo "</td>";
                    echo "<td>"; echo $row['issuedate']; echo "</td>";
                    echo "<td>"; echo $row['returndate']; echo "</td>";
                    echo "<td>"; echo $row['approve']; echo "</td>";
                    echo "<td>"; echo $row['fine']; echo "</td>";
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
    <?php
    if(isset($_GET['req']))
	{
		$id=$_GET['req'];
		mysqli_query($db,"DELETE FROM issueinfo where bookid=$id AND studentid = '$_SESSION[studentid]';");
        $res=mysqli_query($db,"SELECT quantity from books where bookid=$id;");
		while($row=mysqli_fetch_assoc($res))
		{
			if($row['quantity']==0)
			{
				mysqli_query($db,"UPDATE books SET quantity=quantity+1, status='Available' where bookid=$id;");
			}
			else
			{
				mysqli_query($db,"UPDATE books SET quantity=quantity+1 where bookid=$id;");
			}
			
		}
		?>	
		<script type="text/javascript">
			alert("Request Deleted successfully.");
			
		</script>
		<script type="text/javascript">
			window.location="request_book.php";
	    </script>
		<?php
	}
	?>
</body>
</html>