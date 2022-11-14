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
        <title>Add Book Type</title>
        <link rel="stylesheet" href="./assets/vendor/css/main.css">
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

        <div class="container mt-5">
            <div class="wrapper">
                <div class="login-box">
                    <form action="add_type.php" method="post">
                        <h1>Add Type</h1>
                        <div class="form-group">
                            <label class="control-label">Type ID:</label>
                            <input type="text" class="form-control" name="typeid" required>
                            <label class="control-label">Type Name:</label>
                            <input type="text" class="form-control" name="typename" required><br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success" style="margin-right:10px">Add</button>
                                <button type="reset" class="btn btn-danger" style="margin-right:10px">Reset</button>
                                <button class="btn btn-warning"><a style="color:White; text-decoration: none;"href="ad_home.php">Go Back</a></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <script src="./assets/vendor/js/main.js"></script>
    </body>

    </html>
<?php } ?>