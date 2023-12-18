<?php
// Your database connection code here
$servername = "localhost";
        $username = "root";
        $password = ""; // Your MySQL password
        $dbname = "shop";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
// Query to retrieve products from the database

?>
<!DOCTYPE html>
<html>
<head>
  <title>Products</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                  <a class="nav-link" href="index.html">Home</a>
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
              </form>
            </div>
          </div>
        </nav>
      </header>

    
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
        </div>
      </section>
      <section class="products">
        <h1>New Arrivals</h1>
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
                $productInStock = $row["in_stock"];
        
                // Calculate discounted price
                $discountedPrice = $productPrice - $productDiscount;
                $productPage = 'http://localhost/product-detail.php?id=' . $productId;
                if ($productInStock === "Yes") {

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>