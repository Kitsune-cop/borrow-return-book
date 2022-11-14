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
        <title>Book</title>
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
        <div class="container ">
            <div class="wrapper">
                <div class="table-box">
                    <div class="row">
                        <form name="frmSearch" method="get" action="<?= $_SERVER['SCRIPT_NAME']; ?>">
                            <div class="row">
                                <div class="col-6">
                                    <input name="txtKeyword" class="form-control" type="text" id="txtKeyword" value="<?= $_GET["txtKeyword"] ?? ""; ?>">
                                </div>
                                <div class="col-6">
                                    <button type="submit" value="Search" class="btn btn-primary">Search</button>
                                </div>
                                <div class="col-12">
                                    <p></p>
                                </div>
                            </div>
                        </form>
                        <?php
                        include 'connectdb.php';
                        if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                        } else {
                            $pageno = 1;
                        }
                        $no_of_records_per_page = 3;
                        $offset = ($pageno - 1) * $no_of_records_per_page;
                        $text_keyword = $_GET['txtKeyword'] ?? "";
                        $total_pages_sql = "SELECT COUNT(*) FROM book  WHERE (bookName LIKE '%" . $text_keyword . "%' or author LIKE '%" . $text_keyword . "%')";
                        $result = mysqli_query($conn, $total_pages_sql);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                        $sql = " SELECT * FROM (book INNER JOIN borrowstatus ON book.bstatusID = borrowstatus.bstatusID INNER JOIN booktype ON book.bookTypeID = booktype.bookTypeID) WHERE (bookName LIKE '%" . $text_keyword . "%' or author LIKE '%" . $text_keyword . "%' or bookTypeName LIKE '%" . $text_keyword . "%' or publisher LIKE '%" . $text_keyword . "%') LIMIT $offset, $no_of_records_per_page ";
                        $res_data = mysqli_query($conn, $sql);
                        // $rw = mysqli_fetch_array($res_data);
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-hover'>";
                        echo "<thead class='thead-dark'>";
                        echo "<tr class='bg-dark' style='color:White;'><th scope='col'>รูปภาพ</th>";
                        echo "<th scope='col'>ชื่อเรื่อง</th>";
                        echo "<th scope='col'> ประเภท </th>";
                        echo "<th scope='col'>ผู้แต่ง</th>";
                        echo "<th scope='col'>สำนักพิมพ์</th>";
                        echo "<th scope='col'>สถานะ</th>";
                        echo "<th scope='col'></th>";
                        echo "</tr>";
                        echo "</thead>";

                        while ($row = mysqli_fetch_array($res_data)) {
                            if ($row['bName'] == "ว่าง") {
                                $imageURL = 'assets/img/book/' . $row['bookIMG'];
                                //here goes the data​
                                echo "<tbody>";
                                echo "  <tr>";
                                echo "  <td><a href=user_book_detail.php?bookID=" . $row['bookID'] . "><img src='$imageURL'></a></td>";
                                echo "  <td><a style=text-decoration:none;color:Black; href=user_book_detail.php?bookID=" . $row['bookID'] . ">" . $row['bookName'] . "</a></td>";
                                echo "  <td>" . $row['bookTypeName'] . "</td>";
                                echo "  <td>" . $row['author'] . "</td>";
                                echo "  <td>" . $row['publisher'] . "</td>";
                                echo "  <td>" . $row['bName'] . "</td>";
                                echo "  <td><button class='btn btn-primary'><a style=text-decoration:none;color:White; href=add_borrow.php?bookID=" . $row['bookID'] . ">ยืม</a></button></td>";
                                echo "  </tr>";
                                echo "</tbody>";
                            } else {
                                $imageURL = 'assets/img/book/' . $row['bookIMG'];
                                //here goes the data​
                                echo "<tbody>";
                                echo "  <tr>";
                                echo "  <td><a href=user_book_detail.php?bookID=" . $row['bookID'] . "><img src='$imageURL'></a></td>";
                                echo "  <td><a style=text-decoration:none;color:Black; href=user_book_detail.php?bookID=" . $row['bookID'] . ">" . $row['bookName'] . "</a></td>";
                                echo "  <td>" . $row['bookTypeName'] . "</td>";
                                echo "  <td>" . $row['author'] . "</td>";
                                echo "  <td>" . $row['publisher'] . "</td>";
                                echo "  <td>" . $row['bName'] . "</td>";
                                echo "  <td></td>";
                                echo "  </tr>";
                                echo "</tbody>";
                            }
                        }
                        mysqli_close($conn);
                        echo "</table>";
                        echo "</div>";
                        ?>

                        <?php echo "Page: " . $pageno . "/" . $total_pages . "<br>"; ?>
                        <ul class="pagination mb-3">
                            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                            <li class="page-item <?php if ($pageno <= 1) {
                                                        echo 'disabled';
                                                    } ?>"">
                <a class=" page-link" href="<?php if ($pageno <= 1) {
                                                echo '#';
                                            } else {
                                                echo "?pageno=" . ($pageno - 1);
                                            } ?>">Prev</a>
                            </li>
                            <li class="page-item <?php if ($pageno >= $total_pages) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                                echo '#';
                                                            } else {
                                                                echo "?pageno=" . ($pageno + 1);
                                                            } ?>">Next</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>