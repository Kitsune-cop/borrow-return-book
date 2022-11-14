<?php 
    include 'connectdb.php';

    $bookID = $_GET["bookID"];
    $sql = "SELECT * FROM book WHERE bookID = '$bookID'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $path = "assets/img/book/";
    unlink($path.$row['bookIMG']);
    $sql = "DELETE FROM book  WHERE bookID = '$bookID' ";
    $query = mysqli_query($conn, $sql);
    $sql = "DELETE FROM borrow  WHERE borrow.bookID = '$bookID' ";
    $query = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn)) {
        header("Location: ad_book_list.php");
    }
    mysqli_close($conn);
?>