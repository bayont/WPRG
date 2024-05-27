<?php
    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
?>
<style>
   #main-nav {
       background-color: rgb(229, 229, 234);
       color: #222;
       padding: 10px 0;
       width: 100%;
   }

   #main-nav ul {
       width: 80%;
       list-style-type: none;
       margin: 0 auto;
       padding: 0;
       display: flex;
       gap: 20px;
   }

    #main-nav ul li a {
        text-decoration: none;
        color: #222;
    }

    #main-nav ul li:hover a {
        color: #888;
    }

    #main-nav ul li a[href="<?php echo $currentPage; ?>"] {
        color: rgb(20,150,255);
    }
</style>
<nav id="main-nav">
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="all-cars.php">Wszystkie samochody</a></li>
        <li><a href="add-car.php">Dodaj samochód</a></li>
    </ul>
</nav>