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
    <?php
        if(isset($_POST['submit'])){
            date_default_timezone_set("Asia/Dhaka");
            $d = date("m/d/Y l, h:i A");
            // $d=date("y/m/d H:i:s");
            mysqli_query($db,"INSERT into `lms2`.`message` VALUES('','$_SESSION[login_student_username]','$_POST[msg]','no','student','$d');");

            $res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[login_student_username]';");
        }
        else{
            $res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[login_student_username]';");
        }
        mysqli_query($db,"UPDATE message set status='yes' where sender='admin' and username='$_SESSION[login_student_username]';");
    ?>
    <div class="message-container">
        <div class="message-title">
            <h3>Admin</h3>
        </div>
        <div class="msg-text">
            <?php
            while($row=mysqli_fetch_assoc($res)){
                if($row['sender']=='student'){
                    ?>
                    <div class="chat user">
                        <div class="chat-user-img">
                            <?php
                                echo "<img class='user-img' src='images/".$_SESSION['pic']."'>";
                            ?>
                        </div>
                        
                        <div class="chat-box">
                            <p><?php
                                echo $row['message'];
                            ?></p>
                        </div>
                    </div>
                    <?php
                }
                else{
                    $res2 = mysqli_query($db,"SELECT admin.username,pic from admin join message on message.sender= admin.username where message.username='$_SESSION[login_student_username]' ;");
                    $row2 = mysqli_fetch_assoc($res2);
                    ?>
                    <div class="chat admin">
                    <div class="chat-user-img">
                        <?php
                            echo "<img src='images/".$row2['pic']."'>";
                        ?>
                    </div>
                    <div class="username"><p><?php
                                echo $row2['username'];
                                ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                                echo $row['date'];
                            ?></p></div>
                    <div class="chat-box">
                        <p><?php
                                echo $row['message'];
                            ?></p>
                    </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="message-form">
            <form action="" method="post">
                <!-- <input type="text" name="msg" class="msg-control" required placeholder="Write Message Here...."> -->
                <textarea name="msg" id="" required placeholder="Write Message Here...."></textarea>
                <button class="sendbtn" type="submit" name="submit"><i class="fas fa-paper-plane" ></i>&nbsp;Send</button>
            </form>
            
        </div>
    </div>
    
       

</body>
</html>

