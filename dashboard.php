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
  <title>Dashboard</title>
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

      <section class="slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                  <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                  <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/1.jpg" class="d-block w-100" alt="Image 1">
                  </div>
                  <div class="carousel-item">
                    <img src="images/2.jpg" class="d-block w-100" alt="Image 2">
                  </div>
                  <div class="carousel-item">
                    <img src="images/3.png" class="d-block w-100" alt="Image 3">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </a>
              </div>
      </section>
      <section class="products">
        <h1>Our Products</h1>
        <div class="product-cards">
          <div class="product-card">
            <img src="images/shoes1.jpeg" alt="image">
            <h2>Blank lether shoes
            </h2>
            <p class="price">Rs 5000</p>
            <a href="Blanklethershoes.html" class="buy-now">Buy Now</a>
        </div>
    
          <div class="product-card">
            <img src="images/shoes2.webp" alt="image">
            <h2>Tan Moccasins
            </h2>
            <p class="price">Rs 3600</p>
            <a href="TanMoccasins.html" class="buy-now">Buy Now</a>
        </div>
    
          <div class="product-card">
            <img src="images/shoes3.webp" alt="image">
            <h2>SUPER COBALT BLUE</h2>
            <p class="price">Rs 4400</p>
            <a href="SUPERCOBALTBLUE.html" class="buy-now">Buy Now</a>
        </div>
    
          <div class="product-card">
            <img src="images/shoes4.jpeg" alt="image">
            <h2>Super shoes
            </h2>
            <p class="price">Rs 7100</p>
            <a href="supershoes.html" class="buy-now">Buy Now</a>
        </div>
    
          <div class="product-card">
            <img src="images/shoes5.jpeg" alt="image">
            <h2>JUMPER-031 GREY</h2>
            <p class="price">Rs 1450</p>
            <a href="jumpershoes.html" class="buy-now">Buy Now</a>
        </div>
                
        <?php
        // Your database connection code here
      

        // Query to retrieve products from the database
        $sql = "SELECT * FROM products"; // Modify this query as per your database schema
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Fetch product details
                $productId = $row["id"];
                $productName = $row["name"];
                $productImage = $row["image_path"];
                $productPrice = $row["price"];
                $productDiscount = $row["discount"];
                $productPage = $row["page_link"]; // Link to the product page
        
                // Calculate discounted price
                $discountedPrice = $productPrice - $productDiscount;
                $productPage = 'http://localhost/product-detail.php?id=' . $productId;

                // Generate HTML for each product card
                echo '<div class="product-card">';
              //  echo '<img src="' . $productImage . '" alt="' . $productName . '">';
              echo '<img src="image.php?id=' . $productId . '" alt="' . $productName . '">';
                echo '<h2>' . $productName . '</h2>';
           //     echo '<p class="price">Rs ' . $discountedPrice . '</p>'; // Display discounted price
           echo '<p class="discounted-price">Rs <del>' . $productPrice . '</del>  ' . $discountedPrice . '</p>';
           echo '<a href="' . $productPage . '" class="buy-now">Buy Now</a>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }
        $conn->close();
        ?>
        </div>
      </section>

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