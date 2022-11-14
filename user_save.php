<?php
        include 'connectdb.php';
        
        $memberID = $_POST["memberID"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $dob = $_POST["dob"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = " SELECT * FROM member  WHERE memberID = $memberID ";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        if ($result) {
                echo "<script>";
                echo "alert(\" username or password already exist\");"; 
                echo "window.history.back()";
                echo "</script>";
        } else {
                
                $sql = "UPDATE member SET memberId = '$memberID', Firstname = '$fname' ,  Lastname = '$lname', Gender = '$gender', BirthDate = '$dob', Tel = '$phone', Username = '$username', Password = '$password' ,Email = '$email', statusmem = 'MEMBER' WHERE memberID = '$memberID'";
                if (mysqli_query($conn, $sql)) {
                        header("Location: user_home.php");
                } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }
        mysqli_close($conn);
?>
