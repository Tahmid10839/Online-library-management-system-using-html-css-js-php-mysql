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
    
    <?php
        
        $studentid=$_GET['ed'];
        $bookid=$_GET['ed1'];


        $d=date("Y-m-d");
        $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
        $var1='<p style="color:yellow; background-color:green;">RETURNED</p>';
        
        $q2=mysqli_query($db,"UPDATE issueinfo SET returndate='$d',approve='$var1' where studentid='$studentid' and bookid=$bookid and (approve='Yes' or approve='$var') ;");
        mysqli_query($db,"DELETE from timer where stdid='$studentid' and bid='$bookid';");
        $res=mysqli_query($db,"SELECT quantity from books where bookid=$bookid;");
        while($row=mysqli_fetch_assoc($res))
        {
            if($row['quantity']==0)
            {
                mysqli_query($db,"UPDATE books SET quantity=quantity+1, status='Available' where bookid=$bookid;");
            }
            else
            {
                mysqli_query($db,"UPDATE books SET quantity=quantity+1 where bookid=$bookid;");
            }
            
        }
        ?>
        <script type="text/javascript">
            alert("Book returned successfully");
            window.location="manage_issued_books.php";
        </script>
        <?php
        
    ?>
    
</body>
</html>