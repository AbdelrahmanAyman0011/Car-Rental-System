<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>

</head>

<body>
  <header>
    <a href="index.html" class="logo">CAR RENTAL SYSTEM</a>

    <nav class="navigation">
      <ul>
        <li><a href="frontLogin.php">Login</a></li>
      </ul>
    </nav>
  </header>
  <section class="sign_background">
    <div class="sign">

      <div class="title">
        <h1>Registration</h1>
      </div>
      <div class="content">
        <form action="backSignup.php" method="POST" onsubmit="return validateForm();">
          <div class="user-details">
            <div class="input-box">
              <input type="text" name="fname" id="fname" placeholder="First Name" required>
            </div>
            <div class="input-box">
              <input type="text" name="lname" id="lname" placeholder="Last Name" required>
            </div>
            <div class="input-box">
              <input type="text" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-box">
              <input type="text" name="phone" id="phone" placeholder="Phone" required>
            </div>
            <div class="input-box">
              <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="input-box">
              <input type="password" name="rpassword" id="rpassword" placeholder="Repeat password" required>
            </div>
          </div>
          <div class="inline-labels">
            <div class="input-box">
              <input type="text" name="country" id="country" placeholder="Country" required>

              <div class="gender-details">
                <input type="radio" name="gender" id="dot-1">
                <input type="radio" name="gender" id="dot-2">
                <input type="radio" name="gender" id="dot-3">
                <span class="gender-title">Gender</span>
                <div class="category">
                  <label for="dot-1">
                  <span class="dot one"></span>
                  <span class="gender">Male</span>
                </label>
                <label for="dot-2">
                  <span class="dot two"></span>
                  <span class="gender">Female</span>
                </label>
                </div>
              </div>

            </div>
          </div>
      </div>
      <div class="button">
        <button type="submit" name="submit" id="submit" class="Loginbtn">Register</button>
      </div>
      </form>
    </div>
    </div>
    </div>


  </section>

  <script>
    function validateForm() {

      var password = document.getElementById("password").value;
      var passwordRepeat = document.getElementById("rpassword").value;
      var email = document.getElementById("email").value;

      if (password !== passwordRepeat) {
        alert("Passwords do not match. Please try again.");
        return false;
      }
      var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!email.match(emailPattern)) {
        alert("Please enter a valid email address.");
        return false;
      }

      return true;
    }
  </script>
</body>

</html>