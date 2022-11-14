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
        <title>Book Details</title>
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
        <div class="container">
            <div class="wrapper">
                <div class="detail-box">
                    <?php
                    ini_set('display_errors', 1);
                    error_reporting(~0);
                    $bookID = "";
                    if (isset($_GET["bookID"])) {
                        $bookID = $_GET["bookID"];
                    }
                    include 'connectdb.php';
                    $sql = " SELECT * FROM (book INNER JOIN borrowstatus ON book.bstatusID = borrowstatus.bstatusID INNER JOIN booktype ON book.bookTypeID = booktype.bookTypeID) WHERE bookID ='" . $bookID . "'";
                    $query = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
                    $imageURL = 'assets/img/book/' . $result['bookIMG'] ?? "";
                    ?>
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <img src=<?php echo $imageURL ?>>
                        </div>
                        <div class="col-6 border border-dark rounded rounded-2">
                            <label>Book ID:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $bookID ?></p>
                            <label>Book Name:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['bookName'] ?? "" ?></p>
                            <label>Book Type:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['bookTypeName'] ?? "" ?></p>
                            <label>Description:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['bookDescript'] ?? "" ?></p>
                            <label>Author:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['author'] ?? "" ?></p>
                            <label>Publisher:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['publisher'] ?? "" ?></p>
                            <label>Status:</label>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['bName'] ?? "" ?></p>
                            <button class='btn btn-success'><a style='text-decoration:none; color:White;' href="ad_book_edit.php?bookID=<?php echo "$bookID" ?>">Edit</a></button>
                            <button class='btn btn-danger'><a style='text-decoration:none; color:White;' href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='book_del.php?bookID=<?php echo $bookID ?>';}">Delete</a></button>
                            <button class="btn btn-warning"><a style="color:White; text-decoration: none;"href="ad_book_list.php">Go Back</a></button>
                        </div>
                    </div>
                    <?php
                    mysqli_close($conn);
                    ?>
                </div>

            </div>

        </div>
    </body>

    </html>
<?php } ?>