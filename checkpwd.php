<?php 
session_start();
				//connection
                include("connectdb.php");
				//รับค่า user & password
                $Username = $_POST['username'];
                $Password = $_POST['password'];
				//query 
                $sql="SELECT * FROM member WHERE Username='$Username' AND Password='$Password' ";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)==1){

                    $row = mysqli_fetch_array($result);

                    $_SESSION["UserID"] = $row["memberID"];
                    $_SESSION["User"] = $row["Firstname"]." ".$row["Lastname"];
                    $_SESSION["statusmem"] = $row["statusmem"];

                    if($_SESSION["statusmem"]=="ADMIN"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                        Header("Location: ad_home.php");

                    }

                    if ($_SESSION["statusmem"]=="MEMBER"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        Header("Location: user_home.php");

                    }

                }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";

                }
?>

