<?php
        include 'connectdb.php';
        
        $bookID = $_POST["bookid"];
        $bookName = $_POST["name"];
        $bookTypeID = $_POST["typeid"];
        $description = $_POST["descript"];
        $author = $_POST["author"];
        $publisher = $_POST["publisher"];

        $sql = " SELECT * FROM (book INNER JOIN borrowstatus ON book.bstatusID = borrowstatus.bstatusID INNER JOIN booktype ON book.bookTypeID = booktype.bookTypeID) WHERE (bookID ='" . $bookID . "')";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        
        $bookIMG = $result['bookIMG'];
        $targetDir = "assets/img/book/";
        $fileName = basename(($_FILES["bookimg"]["name"]));
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        if(!empty($fileName)){
            move_uploaded_file($_FILES["bookimg"]["tmp_name"], $targetFilePath); 
            unlink($targetDir . $result['bookIMG']);
            $sql = "UPDATE book SET bookIMG = '$fileName', bookName = '$bookName' ,bookTypeID = '$bookTypeID', bookDescript = '$description', author = '$author', publisher = '$publisher' WHERE bookID = '$bookID'";
            $query = mysqli_query($conn, $sql);
            
            header("Location: ad_book.php");
        } else {
            $sql = "UPDATE book SET bookIMG = '$bookIMG', bookName = '$bookName', bookTypeID = '$bookTypeID', bookDescript = '$description', author = '$author', publisher = '$publisher' WHERE bookID = '$bookID'";
            $query = mysqli_query($conn, $sql);
            header("Location: ad_book_list.php");
        }
?>
