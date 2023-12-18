<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform your login verification here
    // For simplicity, let's assume the correct username is "admin" and password is "password"
    if ($username === 'admin' && $password === 'password') {
        // Redirect to the dashboard page upon successful login
        session_start();
    $_SESSION['loggedin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        // Set the error message for incorrect credentials
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">    <style>
        /* Styles for the new 'highlight-error' class */
        .input-field.highlight-error {
            border: 3px solid red;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <img src="images/logo.png" alt="Logo" width="250" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="products.html">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
          </ul>
          <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <i class='bx bx-search-alt-2' ></i>
          
          </form>
        </div>
      </div>
    </nav>
  </header>



    <div class="container" style="margin-top:300px;">
        <div class="login-container">
            <h1>Login</h1>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
            <form id="loginForm" method="POST" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="input-field" placeholder="Enter your username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="input-field" placeholder="Enter your password" required>

                <button type="button" class="login-button" onclick="validateAndSubmit()" style="padding: 10px; background-color: #4caf50; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
    Log In
</button>
            </form>
        </div>
        <div class="info-box">
            <h2>Welcome</h2>
            <p>You need to login in order to visit your dashboard,add/edit or delete products.</p>
        </div>
    </div>

    <footer>
        <p>2023 Hamza. All rights reserved.</p>
        <div class="social-icons" style="color: #000;">
            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>

        </div>
    </footer>

    <script>
        function validateAndSubmit() {
            var usernameInput = document.getElementById('username');
            var passwordInput = document.getElementById('password');

            // Check if username and password fields are empty
            if (usernameInput.value.trim() != 'admin' || passwordInput.value.trim() != 'password') {
                // If either field is empty, highlight both fields with red border
                usernameInput.classList.add('highlight-error');
                passwordInput.classList.add('highlight-error');
            } else {
                // If both fields are filled, remove any error styling
                usernameInput.classList.remove('highlight-error');
                passwordInput.classList.remove('highlight-error');

                // Verify credentials - Replace this with your actual login verification logic
                if (usernameInput.value.trim() !== 'admin' || passwordInput.value.trim() !== 'password') {
                    alert('Invalid username or password'); // Display error message
                } else {
                    document.getElementById('loginForm').submit(); // Submit the form
                }
            }
        }
    </script>

</body>
</html>
