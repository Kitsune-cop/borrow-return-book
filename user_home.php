<?php session_start(); ?>
<?php
if (!$_SESSION["UserID"] || $_SESSION["statusmem"] != "MEMBER") {  //check session

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
        <title>Home</title>
        <link rel="stylesheet" href="assets/vendor/css/style.css">
        <link rel="stylesheet" href="assets/vendor/css/nav.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    </head>

    <body>
        <header class="navi">
            <a href="user_home.php"><img class="logo" src="assets/img/logo.png" alt="Logo"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="user_home.php">Home</a></li>
                    <li><a href="user_book_list.php">Book</a></li>
                    <li><a href="user_borrow.php">Borrow History</a></li>
                </ul>
            </nav>
            <a href="logout.php"><button>Log Out</button></a>
        </header>
        <div class="container">
            <div class="wrapper ">
                <div class="edit-box ">
                    <h1>Hello! <?php echo $row['Firstname'] ?></h1>
                    <h3>Welcome to My Library</h3>
                    Name: <?php echo $row['Firstname'] . ' ' . $row['Lastname'] ?><br>
                    <?php date_default_timezone_set("Asia/Bangkok"); ?>
                    Date: <?php echo date("Y-m-d") ?><br>
                    Time: <?php echo date("H:i:s a") ?><br>
                    <?php 
                    $total = "SELECT COUNT(*) FROM book WHERE bstatusID ='b0000'";
                    $res = mysqli_query($conn, $total);
                    $total_rows = mysqli_fetch_array($res)[0];
                    mysqli_close($conn);
                    ?>
                    Book Balance: <?php echo $total_rows?><br><br>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-success"><a style="text-decoration:none;color:White;" href="user_edit.php">แก้ไขข้อมูลส่วนตัว</a></button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-center mt-2">
                            <button class="btn btn-dark"><a style="text-decoration:none;color:White;" href="user_info.php">Show info</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>