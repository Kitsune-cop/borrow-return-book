<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" href="assets/vendor/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>

<body>
  <!-- <div class="logo">
        <img src="assets/img/logo.png" alt="Logo">
      </div> -->
  <div class="container mt-3 mb-3 ">
    <div class="wrapper d-flex justify-content-center">
      <div class="login-box ">
        <h2>LOG IN</h2>
        <form action="checkpwd.php" method="post">
          <div class="user-box">
            <input type="text" name="username" required="">
            <label>Username</label>
          </div>
          <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Sign In</button>
          </div>
          <div class="d-flex justify-content-center">
            <p style="font-size: 12px">I don't have accounts?<a href="register.php"> Sign Up</a></p>
          </div>
          <div class="d-flex justify-content-center">
            <p style="font-size: 12px"><a href="about.php">About Us</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>

  </div>
  </div>

</body>

</html>