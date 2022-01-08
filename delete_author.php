<?php

	include "connection.php";
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
<?php
    if(isset($_GET['del']))
	{
		$id=$_GET['del'];
		mysqli_query($db,"DELETE authors,books FROM authors inner join books on books.authorid=authors.authorid where  authors.authorid=$id ;");
        mysqli_query($db,"DELETE authors FROM authors where authors.authorid=$id ;");
		?>	
		<script type="text/javascript">
			alert("Author Deleted successfully.");
			
		</script>
		<script type="text/javascript">
			window.location="manage_authors.php";
	</script>
		
		<?php

	}
	?>
    
    
</body>
</html>