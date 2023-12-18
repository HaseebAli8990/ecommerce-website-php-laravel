<?php
// Establish database connection

$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details based on product ID from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = $_GET['id'];

    // Query to retrieve product details
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Fetch and display product details here
        $productName = $row["name"];
        $productImage = $row["image_path"];
        $productPrice = $row["price"];
        $productDiscount = $row["discount"];
        $productSize = $row["size"];
        $productInStock = $row["in_stock"];
        $productDetails = $row["details"];
        // Display other product details as needed
        //...

        // Display product details on the page
        // echo '<h1>' . $productName . '</h1>';
        // echo '<img src="' . $productImage . '" alt="' . $productName . '">';
        // echo '<p>Price: Rs ' . $productPrice . '</p>';
        // echo '<p>Discount: Rs ' . $productDiscount . '</p>';
        // Display other product details as needed
        //...
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
  <title><?php echo  $productName ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
     .more-text {
    display: none;
  }
  
  .more-text.show-full {
    display: block;
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
                  <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="products.php">Products</a>
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


      <section class="product-detail">
        <div class="product-image">
        <?php        echo '<img src="image.php?id=' . $productId . '" alt="' . $productName . '">';?>
        </div>
        <div class="product-info">
          <h1><?php echo  $productName ?> </h1>
          <p class="price"><?php echo "Rs " . $productPrice ?></p>
          <div class="description">
            <p>Welcome to Starlet Shoes, where elegance and comfort meet in perfect harmony.</p>
            <p class="more-text">Our exquisite collection of footwear is meticulously crafted to elevate your style and make you shine like a true star.</p>
          </div>
          <a href="#" class="see-more">See more</a> <br><br>
          
            <h5>Available Size: <?php echo "  ". $productSize ?></h5>
            <h5>In Stock?  <?php echo "  ". $productInStock ?></h5>

            
            <br>
          <br>
          <button class="buy-now">Buy Now</button>
        </div>
      </section>



  <div class="description-container">
  <h1 c>Complete details</h1>
  <?php echo "  ". $productDetails ?>


  </p>
</div>
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
    
          
        </div>
      </section>
  <footer>
    <p>&copy; 2023 Hamza & Haseeb Ali. All rights reserved.</p>
    <div class="social-icons" style="color: #000;">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-pinterest"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>


    </div>
 
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.see-more').click(function(e) {
        e.preventDefault();
        $('.more-text').toggleClass('show-full');
        if ($('.more-text').hasClass('show-full')) {
          $('.see-more').text('See less');
        } else {
          $('.see-more').text('See more');
        }
      });
    });
  </script>
</body>
</html>