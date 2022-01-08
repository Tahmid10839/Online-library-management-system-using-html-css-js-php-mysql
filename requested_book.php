<?php
	
	include "connection.php";
	session_start();

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
    if(isset($_GET['req']))
	{
		$var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
		$q=mysqli_query($db,"SELECT studentid from student where student_username='$_SESSION[login_student_username]';");
		$row=mysqli_fetch_assoc($q);
		$studentid="{$row['studentid']}";
		$id=$_GET['req'];
		$q2=mysqli_query($db,"SELECT * from issueinfo where studentid=$studentid and bookid=$id and (approve=' ' or approve='yes' or approve='$var');");
		$q3=mysqli_query($db,"SELECT * from issueinfo where studentid=$studentid and (approve=' ' or approve='yes' or approve='$var');");
		$total = mysqli_num_rows($q3);
		if($total==3){
			?>
			<script type="text/javascript">
				alert("You already requested three books.You must return one book first.");
			</script>
			<script>
            	window.location="student_books.php";
        	</script>
			<?php
		}
		else if(mysqli_num_rows($q2)!=0)
		{
			?>
			<script type="text/javascript">
				alert("You already requested this book.You must return it first.");
			</script>
			<script>
            	window.location="student_books.php";
        	</script>
			<?php
		}
		else
		{
			$q1=mysqli_query($db,"SELECT * FROM books where bookid=$id and  status='Available';");
		if(mysqli_num_rows($q1)!=0)
		{
			mysqli_query($db,"INSERT INTO issueinfo VALUES('$studentid','$id','','','','');");
			mysqli_query($db,"UPDATE books SET quantity=quantity-1 where bookid=$id;");
		$res=mysqli_query($db,"SELECT quantity from books where bookid=$id;");
		while($row=mysqli_fetch_assoc($res))
		{
			if($row['quantity']==0)
			{
				mysqli_query($db,"UPDATE books SET status='Not Available' where bookid=$id;");
			}
		}
			?>
		<script type="text/javascript">
			alert("book Requested successfully.");
			
		</script>
        <script>
            window.location="student_books.php";
        </script>
		<?php
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("This book is not available you can't request.");
			</script>
			<script>
            	window.location="student_books.php";
        	</script>
			<?php
		}
		}
		
	}

?>
</body>
</html>
