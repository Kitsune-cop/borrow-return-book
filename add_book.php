<?php
    include 'connectdb.php';
    $bookID = $_POST["bookid"];
    $bookName = $_POST["name"];
    $bookTypeID = $_POST["typeid"];
    $description = $_POST["descript"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $targetDir = "assets/img/book/";
    $fileName = basename(($_FILES["bookimg"]["name"]));
    $targetFilePath = $targetDir.$fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
    //check file and insert
    if(!empty($fileName)){
        move_uploaded_file($_FILES["bookimg"]["tmp_name"], $targetFilePath); 
        $sql = "INSERT INTO book (bookID, bookIMG, bookName, bookTypeID, bookDescript, author, publisher, bstatusID) VALUES ('$bookID','$fileName', '$bookName', '$bookTypeID','$description', '$author', '$publisher', 'b0000')";
        $query = mysqli_query($conn, $sql);
        header("Location: add_book_succ.php");
    } else {
        move_uploaded_file($_FILES["bookimg"]["tmp_name"], $targetFilePath); 
        $sql = "INSERT INTO book (bookID, bookName, bookTypeID, bookDescript, author, publisher, bstatusID) VALUES ('$bookID', '$bookName', '$bookTypeID', '$description','$author', '$publisher', 'b0000')";
        $query = mysqli_query($conn, $sql);
        header("Location: add_book_succ.php");

    }
    mysqli_close($conn);

?>
