<?php session_start(); ?>
<?php
if (!$_SESSION["UserID"] || $_SESSION["statusmem"] != "ADMIN") {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
    include 'connectdb.php';
    $ID = $_SESSION["UserID"];
    $sql = "SELECT * FROM member WHERE memberID='$ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Show info</title>
        <link rel="stylesheet" href="assets/vendor/css/style.css">
        <link rel="stylesheet" href="assets/vendor/css/nav.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    </head>

    <body>
        <header class="navi">
            <a href="ad_home.php"><img class="logo" src="assets/img/logo.png" alt="Logo"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="ad_home.php">Home</a></li>
                    <li><a href="ad_book_list.php">Book</a></li>
                    <li><a href="ad_add_book.php">Add Book</a></li>
                    <li><a href="ad_history.php">Borrow History</a></li>
                </ul>
            </nav>
            <a href="logout.php"><button>Log Out</button></a>
        </header>
        <?php

        $fname = $row['Firstname'];
        $lname = $row['Lastname'];
        $gender = $row['Gender'];
        $bdate= $row['BirthDate'];
        $tel = $row['Tel'];
        $em = $row['Email'];
        $stat = $row['statusmem'];
        
        mysqli_close($conn);

        ?>
        <div class="container">

            <div class="wrapper ">
                <div class="edit-box ">
                    <h2><u>About Me</u></h2>
                        <h5>ID : <?php echo $ID ?></h5>
                        <h5>Firstname : <?php echo $fname ?></h5>
                        <h5>Lastname : <?php echo $lname ?></h5>
                        <h5>Gender : <?php echo $gender ?></h5>
                        <h5>Date of Birth : <?php echo $bdate ?></h5>
                        <h5>Tel : <?php echo $tel ?></h5>
                        <h5>Email : <?php echo $em ?></h5>
                        <h5>Status : <?php echo $stat ?></h5>
                        <div class="d-flex justify-content-center mt-2">
                                <a href="ad_home.php"><button class="btn btn-primary">Back</button></a>
                            </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>