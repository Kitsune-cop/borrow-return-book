<?php session_start(); ?>
<?php
if (!$_SESSION["UserID"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
    include 'connectdb.php';
    $ID = $_SESSION["UserID"];
    $sql = "SELECT * FROM member  WHERE memberID='$ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $datestr = date("Y-m-d");
    $dateend = date("Y-m-d", strtotime("+30 days"));
    $bookID = $_GET["bookID"];

    $sql = "INSERT INTO borrow (bookID, memberID, dateBorrow, dateRet, statusID)VALUES ('$bookID','$ID','$datestr','$dateend','b0003')";
    if (mysqli_query($conn, $sql)) {
        $sql = "UPDATE book SET bstatusID = 'b0001' WHERE book.bookID = '$bookID'";
        $query = mysqli_query($conn, $sql);
        header("Location:user_borrow.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>
<?php } ?>