<?php

session_start();

?>
<!DOCTYPE html>
<html>

<!-- Head start -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>URL Shortener</title>
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
</head>
<!-- Head End -->

<!-- Body Start -->
<body>

 <header class="masthead text-center text-white">
      <div class="masthead-content">
        <div class="container">
          <h2 class="masthead-subheading mb-0">Shorten a URL</h2>
        </div>
      </div>
      <div class="bg-circle-1 bg-circle"></div>
      <div class="bg-circle-2 bg-circle"></div>
      <div class="bg-circle-3 bg-circle"></div>
      <div class="bg-circle-4 bg-circle"></div>
    </header>

   
<!--         <h1 class="title">Shorten a URL.</h1> -->
        <?php
			if(isset($_SESSION['user']))        
			{
				echo "<p>{$_SESSION['user']}</p>";  
				unset($_SESSION['user']);
			}
		?>
        <br><br>
    <section>
      <div class="container">
		   <!-- Form Open -->
            <form action="shorten.php" method="post">
                <input type="url" name="url" placeholder="Enter a URL here." autocomplete="off" />
                <input type="submit" class="btn btn-primary btn-xl rounded-pill mt-1" value="Shorten" />
            </form><!-- Form Close -->
        </div>
    </section>
    </div>
</body>
<!-- Body End -->

</html>