<?php session_start(); ?>
<?php
if (!$_SESSION["UserID"] || $_SESSION["statusmem"] != "ADMIN") {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
    include 'connectdb.php';
    $ID = $_SESSION["UserID"];
    $sql = "SELECT * FROM member  WHERE memberID='$ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $borrowID = $_GET["borrowID"];
    $msql = "SELECT * FROM borrow  INNER JOIN book ON borrow.bookID = book.bookID WHERE borrow.borrowID='$borrowID'";
    $mresult = mysqli_query($conn, $msql);
    $rw = mysqli_fetch_array($mresult);
    $memberID = $rw['memberID'];
    $datestr = date("Y-m-d");
    $bookID = $rw['bookID'];
    $sql = "UPDATE borrow SET retDate = '$datestr', statusID = 'b0002' WHERE borrow.borrowID = '$borrowID'";
    if (mysqli_query($conn, $sql)) {
        $sql = "UPDATE book SET bstatusID ='b0000' WHERE book.bookID = '$bookID'";
        $query = mysqli_query($conn, $sql);
        header("Location:ad_history.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>