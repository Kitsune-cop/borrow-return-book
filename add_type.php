<?php
    include 'connectdb.php';
    $typeID = $_POST["typeid"];
    $typeName = $_POST["typename"];

    $sql = "SELECT * FROM booktype WHERE (bookTypeID = '$typeID')";
    $objQuery = mysqli_query($conn, $sql);
    $objResult = mysqli_fetch_array($objQuery);
    if ($objResult) {
        $err = "TypeID already exist";
    } else {
        $sql = "INSERT INTO booktype (bookTypeID, bookTypeName )VALUES ('$typeID','$typeName') ";
        if (mysqli_query($conn, $sql)) {
            header("Location:add_type_succ.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);

?>
