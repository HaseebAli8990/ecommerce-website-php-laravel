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
    <title>View Products</title>
    <style>
        /* Your CSS styles */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-left: 50px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #ff0000;
            color: white;
            border: none;
        }
        .edit-btn {
            background-color: #008CBA;
            color: white;
            border: none;
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
              <a class="nav-link" href="/dashboard.php ">Dashboard</a>
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
    <h2>Products</h2>
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Category</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Size</th>
        <th>Product in Stock</th>
        <th>Action</th>
    </tr>
    <?php
    // Database connection for the product table
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your MySQL password
    $dbname = "shop";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //delete query
    if (isset($_GET['delete_id'])) {
      $delete_id = $_GET['delete_id'];
      $sql = "DELETE FROM products WHERE id = $delete_id";
      if ($conn->query($sql) === TRUE) {
          // Product successfully deleted from the database
          echo '<p>Product deleted successfully!</p>';
      } else {
          echo "Error deleting product: " . $conn->error;
      }
  }
    // Query to retrieve products from the database
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Retrieving product information
            $productId = $row["id"];
            $productName = $row["name"];
            $productCategory = $row["category"];
            $productPrice = $row["price"];
            $productDiscount = $row["discount"];
            $productSize = $row["size"];
            $productInStock = $row["in_stock"];
            $productImage = $row["image_path"]; // assuming the column name is 'image_path'

            echo '<tr>';
            echo '<td>' . $productId . '</td>';
            echo '<td>' . $productName . '</td>';
            echo '<td><img src="image.php?id=' . $productId . '" alt="' . $productName . '" width="50"></td>';
            echo '<td>' . $productCategory . '</td>';
            echo '<td>$' . $productPrice . '</td>';
            echo '<td>$' . $productDiscount . '</td>';
            echo '<td>' . $productSize . '</td>';
            echo '<td>' . $productInStock . '</td>';
            echo '<td>';
            if ($productInStock === "Yes") {
                echo '<a href="product-detail.php?id=' . $productId . '" class="button edit-btn" style="background-color: green;">View</a>';
            }
            echo '<a href="edit-product.php?id=' . $productId . '" class="button edit-btn">Edit</a>';
            echo '<a href="view-product.php?delete_id=' . $productId . '" class="button delete-btn">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo "<tr><td colspan='9'>No products found.</td></tr>";
    }

    $conn->close();
    ?>
</table>



</body>
</html>

<footer style="position: fixed; bottom: 0; width: 100%; background-color: #f2f2f2; padding: 20px; text-align: center;">


  <!-- Include Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


