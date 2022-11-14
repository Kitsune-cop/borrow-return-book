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
        <title>Register Admin</title>
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
        <?php
        include 'connectdb.php';
        $err = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $sql = "SELECT * FROM member WHERE (Username = '" . $_POST["username"] . "' OR Password = '" . $_POST["password"] . "')";
            $objQuery = mysqli_query($conn, $sql);
            $objResult = mysqli_fetch_array($objQuery);
            if ($objResult) {
                $err = "Username or Password already exist";
            } else {
                $sql = "INSERT INTO member (FirstName, LastName, Gender, BirthDate, Tel, Username, Password, Email,statusmem)VALUES ('" . $_POST["fname"] . "','" . $_POST["lname"] . "','" . $_POST["gender"] . "','" . $_POST["dob"] . "','" . $_POST["phone"] . "','" . $_POST["username"] . "','" . $_POST["password"] . "','" . $_POST["email"] . "','ADMIN') ";
                if (mysqli_query($conn, $sql)) {
                    header("Location:ad_regissuc.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
            mysqli_close($conn);
        }
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>


        <div class="container">
            <!-- <div class="logo">
            <img class="mt-2 img-fluid" src="assets/img/logo.png" alt="Logo" width="290px" height="90px">
        </div> -->
            <div class="wrapper ">
                <div class="edit-box ">
                    <h2>Admin Register</h2>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                        <p><span class="error"><?php echo $err ?></span></p>
                        <div class="form-group">
                            <label class="control-label">Firstname</label>
                            <input type="text" class="form-control" name="fname" required>
                            <label class="control-label">Lastname</label>
                            <input type="text" class="form-control" name="lname" required><br>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Male">
                                        <label class="form-check-label" for="gridRadios1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Female">
                                        <label class="form-check-label" for="gridRadios2">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="text" class="form-control" name="Other" hidden>
                            <label class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            <label class="control-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
                            <label class="control-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob">
                            <label class="control-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" required><br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success" style="margin-right:10px">Sing Up</button>
                                <button type="reset" class="btn btn-danger" style="margin-right:10px">Reset</button>
                                <button class="btn btn-warning"><a style="color:White; text-decoration: none;" href="ad_home.php">Go Back</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>