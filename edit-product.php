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

// Check if the form is submitted for updating the product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['id'];
    
    $productName = $_POST['name'];
    $productCategory = $_POST['category'];
    $productPrice = $_POST['price'];
    $productDiscount = $_POST['discount'];
    $productSize = $_POST['size'];
    $productInStock = $_POST['in_stock'];

    // Query to update the product details
    $sql = "UPDATE products SET name = '$productName', category = '$productCategory', 
            price = '$productPrice', discount = '$productDiscount', 
            size = '$productSize', in_stock = '$productInStock' WHERE id = '$productId'";

    if ($conn->query($sql) === TRUE) {
      echo '<h4 style="margin-top: 50px; text-align: center;">Product updated successfully <a href="product-detail.php?id=' . $productId . '" class="button edit-btn">View Product</a></h4>';

    } else {
        echo "Error updating product: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Query to retrieve product details based on ID
    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $productId = $row["id"];
      $productName = $row["name"];
      $productImage = $row["image_path"];
      $productCategory = $row["category"];
      $productPrice = $row["price"];
      $productDiscount = $row["discount"];
      $productSize = $row["size"];
      $productInStock = $row["in_stock"];
  
      // Handle form submission for updating product details
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Check if an image file is selected
          if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
              $target_dir = "/opt/lampp/htdocs/uploads/";
              $target_file = $target_dir . basename($_FILES["new_image"]["name"]);
              $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  
              // Validate file type (you might add additional validation)
              if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                  if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file)) {
                      // Save the new image path to the database
                      $newImagePath = $target_file;
  
                      // Update product details including the new image path
                      $sql = "UPDATE products SET name = '$productName', image_path = '$newImagePath', category = '$productCategory', price = '$productPrice', discount = '$productDiscount', size = '$productSize', in_stock = '$productInStock' WHERE id = $productId";
  
                      if ($conn->query($sql) === TRUE) {
                          echo "<p>Product updated successfully!</p>";
                      } else {
                          echo "Error updating product: " . $conn->error;
                      }
                  } else {
                      echo "Sorry, there was an error uploading your file.";
                  }
              } else {
                  echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
              }
          } else {
              // If no new image is selected, update other details without changing the image
              $sql = "UPDATE products SET name = '$productName', category = '$productCategory', price = '$productPrice', discount = '$productDiscount', size = '$productSize', in_stock = '$productInStock' WHERE id = $productId";
  
              if ($conn->query($sql) === TRUE) {
                  echo "<p>Product updated successfully!</p>";
              } else {
                  echo "Error updating product: " . $conn->error;
              }
          }
      }
  
      // Display the form with pre-filled product details for editing
      ?>
      <h2>Edit Product</h2>
      <form method="POST" action="" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $productId; ?>">
          Product Name: <input type="text" name="name" value="<?php echo $productName; ?>"><br><br>
          Current Image: <img src="/image.php?id=<?php echo $productId; ?>" alt="<?php echo $productName; ?>" width="100"><br><br>
          New Image: <input type="file" name="new_image"><br><br>
          Category: <input type="text" name="category" value="<?php echo $productCategory; ?>"><br><br>
          Price: <input type="text" name="price" value="<?php echo $productPrice; ?>"><br><br>
          Discount: <input type="text" name="discount" value="<?php echo $productDiscount; ?>"><br><br>
          Size: <input type="text" name="size" value="<?php echo $productSize; ?>"><br><br>
          In Stock: <input type="text" name="in_stock" value="<?php echo $productInStock; ?>"><br><br>
          <input type="submit" value="Update">
      </form>
      <?php
  }
  
  // Process the form submission for updating the product
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Handle form submission to update the product details, including the image
      $productId = $_POST['id'];
      $newProductName = $_POST['name'];
      $newProductCategory = $_POST['category'];
      $newProductPrice = $_POST['price'];
      $newProductDiscount = $_POST['discount'];
      $newProductSize = $_POST['size'];
      $newProductInStock = $_POST['in_stock'];
  
      // Handle the uploaded image
      if ($_FILES['new_image']['size'] > 0) {
          $targetDirectory = "/opt/lampp/htdocs/uploads"; // Replace this with your upload directory path
          $targetFileName = basename($_FILES['new_image']['name']);
          $targetFilePath = $targetDirectory . $targetFileName;
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
  
          // Check if the image file is an actual image or fake image
          $check = getimagesize($_FILES['new_image']['tmp_name']);
          if ($check !== false) {
              $uploadOk = 1;
          } else {
              $uploadOk = 0;
          }
  
          // Check file size
          if ($_FILES['new_image']['size'] > 500000) {
              $uploadOk = 0;
          }
  
          // Allow only certain file formats
          if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
              && $imageFileType != "gif") {
              $uploadOk = 0;
          }
  
          // If everything is okay, try to upload file
          if ($uploadOk == 1) {
              if (move_uploaded_file($_FILES['new_image']['tmp_name'], $targetFilePath)) {
                  // Update the image path in the database
                  $newImagePath = $targetFilePath;
                  // Perform the update query to update other product details along with the image path
                  // ... Your update query logic goes here
              }
          }
      }
  
      // Update other product details in the database (excluding image if not updated)
      // ... Your update query logic goes here
  }
}
  

$conn->close();
?>

<!DOCTYPE HTML>
<head>
    <title> Edit product </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            width: 50%;
            margin: 0 auto;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
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
 



  <!-- Include Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    