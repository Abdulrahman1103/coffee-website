<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title> Coffee Website </title>

    <!-- CSS Link -->
    <link rel="stylesheet" href="styleHL.css">
    
    
</head>

    <form action="phpfil.php" method="post">

    <header class="header">

      <!-- Navigation bar section -->
    <nav class="navbar">
        
        <div class="logo">
            <img src="images/logo.png" alt="Logo"> 
        </div>

        
        <ul class="nav-links" id="nav-links">
        <li><a href="../LogIn-Regster/homepage.php" class="active">Home</a></li> 
            <li><a href="../Story/story.html">Story</a></li>
            <li><a href="../Meun/index.html">Menu</a></li>
            <li><a href="../Delivery/index.html">Delivery</a></li>
            <li><a href="../Contact/contact.html">Contact</a></li>
            <li><a href="logout.php" class="btn Login-in"> Log-out</a></li>
        </ul>

    </nav>
</header>

    <!-- Hero section -->
    <section class="hero-section" id="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="custom-hr">
                    <div class="diamond"></div> 
                </div>

                <h1>Great coffee for some joy</h1>
                <p>There are people who can’t start their day without having a freshly brewed cup of coffee and we understand them.</p>

                <a href="../Order now/order_now.php" class="btn order-btn">Order Now</a>
            </div>

            
        </div>
    </section>
    
</form>

</body>
</html>
