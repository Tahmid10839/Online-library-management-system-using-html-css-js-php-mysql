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
    <title>Student Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body style="width: 1536px;">
    <?php
    $sql1=mysqli_query($db,"SELECT student.studentpic,FullName,message.username,message from student inner join message on student.student_username=message.username group by username order by status;");
    
    ?>
    <div class="left-box">
        <div class="left-box2">
        <!-- <form action="" method='post' style="margin-top:10px;">
                <input type="search" name='search' placeholder='Search by Student Name' style="padding: 10px;margin-left:25px;margin-top:10px;border-radius:20px;outline:none;">
                <button type='submit' name='usersearch' class='msg-search'><i class="fas fa-search"></i></button>
            </form> -->
            <div class="list">
                <?php
                    echo "<table id='table' class='table'>";
                    while($res1=mysqli_fetch_assoc($sql1)){

                        echo "<tr>";
                        // echo "<td>";
                        // echo "<img height=60px width=60px style='border-radius: 50%' src='images/".$res1['studentpic']."'>";
                        // echo "</td>";
                        // echo "<td>";
                        // echo $res1['FullName'];
                        // echo "</td";
                        
                        echo "<td>
                        <div class='table-info'>
                            <img height=60px width=60px style='border-radius: 50%' src='images/".$res1['studentpic']."'>
                            <div>
                                <p>";echo $res1['FullName'];echo"</p>";
                                // echo"<small>";echo $res1['FullName']; echo " sent ";echo $res1['total']; echo" messages";echo"</small>";
                                $sql2=mysqli_query($db,"SELECT COUNT(status) as total from message where '$res1[username]'=message.username and status='no' and sender='student';");
                                $res2=mysqli_fetch_assoc($sql2);
                                if(mysqli_num_rows($sql2)==0){
                                    echo"<small style='font-size:12px; padding-left:10px;padding-top:0;'> 0"; echo" unread messages";echo"</small>";
                                }
                                else{
                                    echo"<small style='font-size:12px; padding-left:10px;padding-top:0;'>";echo $res2['total']; echo" unread messages";echo"</small>";
                                }
                                
                                // echo"<small style='font-size:10px; padding-left:10px;padding-top:0;'>";echo $res1['message'];echo"</small>";?>
                                <a href="?req=<?php echo $res1['username'];?>"><button type='submit' name='show' style="margin-left:10px;">Show</button></a>
                            </div>
                        </div>
                        </td><?php
                        echo "</tr>";
                    }
                    echo "</table>";

                ?>    
            </div>
        </div>
    </div>
    <div class="right-box">
        <div class="right-box2">
            <?php
            if(isset($_GET['req'])){
                $username = $_GET['req'];
                // echo $username;
                if($username!=''){$_SESSION['stdusername']=$username;}
                if(isset($_POST['submit'])){
                    date_default_timezone_set("Asia/Dhaka");
                    $d = date("m/d/Y l, h:i A");
                    mysqli_query($db,"INSERT into `lms2`.`message` VALUES('','$_SESSION[stdusername]','$_POST[msg]','no','admin','$d');");

                    $res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[stdusername]';");
                }
                else{
                    $res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[stdusername]';");
                }
                mysqli_query($db,"UPDATE message set status='yes' where sender='student' and username='$_SESSION[stdusername]';");
                $sql1=mysqli_query($db,"SELECT student.studentpic,FullName from student where student_username = '$_SESSION[stdusername]';");
                $sql2=mysqli_query($db,"SELECT * FROM message where username = '$_SESSION[stdusername]';");
                while($row=mysqli_fetch_assoc($sql1)){
                    ?>
                    <div style="height: 70px; width:100%; text-align:center; background-color: teal; color:white; padding-top:8px;display:flex;">
                    <?php echo "<img height=60px width=60px style='border-radius: 50%;margin-left:260px;' src='images/".$row['studentpic']."'>"?>
                    <h3 style="padding-top:10px;padding-left:10px;"><?php echo  $row['FullName']?></h3>
                    </div>
                    <?php
                }
                ?>
                <div class="msg-text" style="height:480px;">
            <?php
            while($row=mysqli_fetch_assoc($sql2)){
                if($row['sender']=='admin'){
                    ?>
                    <div class="chat user">
                        <div class="chat-user-img">
                            <?php
                                echo "<img class='user-img' src='images/".$_SESSION['pic1']."'>";
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
                    $sql1=mysqli_query($db,"SELECT student.studentpic,FullName from student where student_username = '$_SESSION[stdusername]';");
                    $row2 = mysqli_fetch_assoc($sql1);
                    ?>
                    <div class="chat admin">
                    <div class="chat-user-img">
                        <?php
                            echo "<img src='images/".$row2['studentpic']."'>";
                        ?>
                    </div>
                    <div class="username"><p><?php
                                echo $row2['FullName'];
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
                ?>
                <div class="message-form">
                    <form action="" method="post">
                        <!-- <input type="text" name="msg" class="msg-control" required placeholder="Write Message Here...."> -->
                        <textarea name="msg" id="" required placeholder="Write Message Here...."></textarea>
                        <button class="sendbtn" type="submit" name="submit"><i class="fas fa-paper-plane" ></i>&nbsp;Send</button>
                    </form>
                    
                </div>
            <?php

            }
            else{
                if(isset($_POST['submit'])){
                    date_default_timezone_set("Asia/Dhaka");
                    $d = date("m/d/Y l, h:i A");
                    mysqli_query($db,"INSERT into `lms2`.`message` VALUES('','$_SESSION[stdusername]','$_POST[msg]','no','admin','$d');");

                    $res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[stdusername]';");
                }
                else{
                    $res = mysqli_query($db,"SELECT * from message where username = '$_SESSION[stdusername]';");
                }
                mysqli_query($db,"UPDATE message set status='yes' where sender='student' and username='$_SESSION[stdusername]';");
                $sql1=mysqli_query($db,"SELECT student.studentpic,FullName from student where student_username = '$_SESSION[stdusername]';");
                
                while($row=mysqli_fetch_assoc($sql1)){
                    ?>
                    <div style="height: 70px; width:100%; text-align:center; background-color: teal; color:white; padding-top:8px;display:flex;">
                    <?php echo "<img height=60px width=60px style='border-radius: 50%;margin-left:260px;' src='images/".$row['studentpic']."'>"?>
                    <h3 style="padding-top:10px;padding-left:10px;"><?php echo  $row['FullName']?></h3>
                    </div>
                    <?php
                }
                ?>
                <div class="msg-text" style="height:480px;">
            <?php
            while($row=mysqli_fetch_assoc($res)){
                if($row['sender']=='admin'){
                    ?>
                    <div class="chat user">
                        <div class="chat-user-img">
                            <?php
                                echo "<img class='user-img' src='images/".$_SESSION['pic1']."'>";
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
                    $sql1=mysqli_query($db,"SELECT student.studentpic,FullName from student where student_username = '$_SESSION[stdusername]';");
                    $row2 = mysqli_fetch_assoc($sql1);
                    ?>
                    <div class="chat admin">
                    <div class="chat-user-img">
                        <?php
                            echo "<img src='images/".$row2['studentpic']."'>";
                        ?>
                    </div>
                    <div class="username"><p><?php
                                echo $row2['FullName'];
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
                ?>
                <div class="message-form">
                    <form action="" method="post">
                        <!-- <input type="text" name="msg" class="msg-control" required placeholder="Write Message Here...."> -->
                        <textarea name="msg" id="" required placeholder="Write Message Here...."></textarea>
                        <button class="sendbtn" type="submit" name="submit"><i class="fas fa-paper-plane" ></i>&nbsp;Send</button>
                    </form>
                    
                </div>
            <?php
                
            }
            ?>
        </div>
    </div>
    
       

</body>
</html>

