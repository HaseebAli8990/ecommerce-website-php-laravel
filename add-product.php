<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        /* Your existing CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 800px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 600px;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
     <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
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
              <a class="nav-link" href="add-product.php">Add Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view-product.php">view product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?logout=true">Logout</a>

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
  <h2 style="text-align: center;">Add Product</h2>

   <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your MySQL password
    $dbname = "shop";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $discount = $_POST["discount"];
        $size = $_POST["size"];
        $details = $_POST["details"];
        $in_stock = $_POST["in_stock"];

        // Image upload handling
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // $target_dir = "opt/lampp/htdocs/uploads/";
            $target_dir = "/opt/lampp/htdocs/uploads/"; // Ensure the correct path to your uploads directory

            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate file type (you might add additional validation)
            if ($imageFileType == "jpg" || $imageFileType == "
            png" || $imageFileType == "jpeg") {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Save the image path to the database
                    $image_path = $target_file;

                    // SQL query to insert data into 'products' table
                    $sql = "INSERT INTO products (name, image_path, category, price, discount, size, details, in_stock)
                            VALUES ('$name', '$image_path', '$category', '$price', '$discount', '$size', '$details', '$in_stock')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p>New product added successfully!</p>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            }
        }
    }
    $conn->close();
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*"><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br><br>

        <label for="discount">Discount:</label>
        <input type="number" name="discount" step="0.01" value="0"><br><br>

        <label for="size">Size:</label>
        <select name="size" required>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select><br><br>

        <label for="details">Details:</label><br>
        <textarea name="details" rows="4" cols="50"></textarea><br><br>

        <label for="in_stock">Product in Stock:</label>
        <input type="radio" name="in_stock" value="yes" checked>Yes
        <input type="radio" name="in_stock" value="no">No<br><br>

        <input type="submit" value="Submit">
    </form>
    
<footer>
    <p>2023 Hamza. All rights reserved.</p>
    <div class="social-icons" style="color: #000;">
      <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
      <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
      <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
      <a href="https://www6.printest.com/"><i class="fab fa-pinterest"></i></a>
      <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
    </div>
  </footer>

  <!-- Include Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

  


</body>
</html>


