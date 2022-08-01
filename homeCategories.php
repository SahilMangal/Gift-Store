    <?php

    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION["giftStoreAdmin"])) {    
        echo "<SCRIPT type='text/javascript'> 
                window.location.replace(\"categoriesPage.php\");
                </SCRIPT>";
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Categories | Gift Store</title>
    <link rel="icon" type="image/x-icon" href="Images/Logo/fav-icon.png">
    <script src="Javascript/javascript.js" type="text/javascript"></script>
    <script src="Javascript/slideShow.js" type="text/javascript"></script>

    <!-- CSS  -->
    <link rel="stylesheet" href="Stylesheet/base.css">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageHeaderStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageFooterStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/categoriesPageStyle.css">
    <link rel="stylesheet" href="Stylesheet/homeCategoryPage.css">

</head>
<body style="background-image: url('Images/tile.jpeg'); background-attachment: fixed;">

    <?php include('pageHeader.php'); ?>

    <?php
        $cat = $_GET['category'];
        $selectCategory = "select * from categoryNames where category_id = '$cat'";
        $result = mysqli_query($connection, $selectCategory);
        $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container categoriesPageBody2">
        <h1> <?php echo $row['category_name']; ?> </h1>
        <span class="totalProducts"> Total Products: <?php echo $row['category_total_count']; ?></span><br/><br/>

        <div class="row">
            
            <?php
                $getProductsInfo = "select products.prod_id, products.prod_category_id, categoryNames.category_name, products.prod_name, products.prod_description, products.prod_price, products.prod_brand, products.prod_image FROM products, categoryNames WHERE products.prod_category_id = '$cat' and categoryNames.category_id = '$cat';";
                $array = array();
                $query = mysqli_query($connection,$getProductsInfo);
                while ($row = mysqli_fetch_assoc($query)) {
                    $array[] = $row;
                }
                $myrow = $array;
                foreach ($myrow as $row) {
                    //breaking point
            ?>

            <div class="col-lg-2 card catCard">
                <div class="imgClass">
                    <a href="prodDesc.php?prod=<?php echo $row['prod_id'];?>&cat=<?php echo $row['prod_category_id'];?>">
                        <img src="<?php echo $row['prod_image']?>" />
                    </a>
                </div>
                <strong class="CategoryName">
                    <?php echo $row['prod_name']?>
                </strong>
                <span class="brand">
                    <?php echo $row['prod_brand']?>
                </span>
                <span class="priceTag">
                    <span style="color: var(--lightLime);">$</span><?php echo $row['prod_price']?>
                </span>
            </div>

            <?php } ?>


        </div>
    </div>

    <?php include('pageFooter.php'); ?>    
</body>
</html>