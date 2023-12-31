<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin page</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>

</head>

<body>
  <header>
    <a href="adminHome.html" class="logo">Admin</a>

    <nav class="navigation">
      <ul>
        <li><a href="adminHome.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.html"><i class="far fa-calendar-alt"></i> Log-OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="adminNav">
    <div class="signRegist">
      <form method="POST" action="RegistOffice.php">
        <h1>Register an Office</h1>


        <div class="form-group">
          <input type="text" placeholder="Capacity" name="capacity" id="capacity" required>

          <input type="text" placeholder="Location" name="location" id="location" required>

        </div>


        <div class="signRegist">
          <button type="submit" name="submit" class="registbtn">Register</button>

        </div>


      </form>
    </div>
  </section>



</body>

</html>