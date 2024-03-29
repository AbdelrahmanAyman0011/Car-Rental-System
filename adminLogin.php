<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login admin</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>

</head>

<body>
  <header>
    <a href="index.html" class="logo">Admin</a>

    <nav class="navigation">
      <ul>
        <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="frontSignup.php">Sign Up</a></li>
      </ul>
    </nav>
  </header>

  <section class="adminNav">
    <div class="sign">
      <form method="POST">
        <h1>Admin Login</h1>
        <input type="text" placeholder="Email" id="email" name="email" required>

        <input type="password" placeholder="Password" id="password" name="password" required>
        <label>
          <input class="chkbox" type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        <button type="submit" name="submit" class="Loginbtn">Login</button>

        <a href=frontLogin.php>Customer</a>
      </form>
    </div>
  </section>

  <?php
if(isset($_POST["submit"])){
    if($_POST["email"] == "admin" && $_POST["password"] == "admin"){
      header("location:adminHome.html");
    }else {
      header("location:adminLogin.php?error=wrongAdminLogin");
    }
  }
  ?>

</body>

</html>