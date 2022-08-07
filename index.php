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

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Home | Gift Store</title>
    <link rel="icon" type="image/x-icon" href="Images/Logo/fav-icon.png">
    <script src="Javascript/javascript.js" type="text/javascript"></script>
    <script src="Javascript/slideShow.js" type="text/javascript"></script>


    <!-- CSS  -->
    <link rel="stylesheet" href="Stylesheet/base.css">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageHeaderStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageFooterStylesheet.css">


    <script type="text/javascript">
    </script>

    <style type="text/css">
        .sliderShowContainer .slider {
            display: none;
        }
    </style>

</head>
<body style="background-image: url('Images/tile.jpeg'); background-attachment: fixed;">

    <?php include('pageHeader.php'); ?>

    <?php if(isset($_SESSION['customer'])) { ?>
    <div class="container" style="background-color: var(--lightBrown); padding: 5px 20px; border: 2px solid var(--border); border-radius: 0px 0px 5px 5px;">
        <h5 style="font-family: Chalkduster; color: var(--lightLime); text-shadow: 0px 0px 2px black;">
            Welcome Back !!<br> <?php echo $_SESSION['customer']?>
        </h5>
    </div>
    <?php } ?>

    <!-- Slideshow container -->
    <div class="container sliderShowContainer">

        <!-- Full-width images with number and caption text -->
        <div class="slider">
            <div class="numbertext">1 / 9</div>
            <img src="Images/Slider/slider1.png">
        </div>

        <div class="slider">
            <div class="numbertext">2 / 9</div>
            <img src="Images/Slider/slide6.jpeg">
        </div>

        <div class="slider">
            <div class="numbertext">3 / 9</div>
            <img src="Images/Slider/slide7.jpeg">
        </div>

        <div class="slider">
            <div class="numbertext">4 / 9</div>
            <img src="Images/Slider/slide8.jpeg">
        </div>

        <div class="slider">
            <div class="numbertext">5 / 9</div>
            <img src="Images/Slider/slide9.jpeg">
        </div>

        <div class="slider">
            <div class="numbertext">6 / 9</div>
            <img src="Images/Slider/slide2.png">
        </div>

        <div class="slider">
            <div class="numbertext">7 / 9</div>
            <img src="Images/Slider/slide3.jpeg">
        </div>

        <div class="slider">
            <div class="numbertext">8 / 9</div>
            <img src="Images/Slider/slide4.jpeg">
        </div>

        <div class="slider">
            <div class="numbertext">9 / 9</div>
            <img src="Images/Slider/slide5.jpeg">
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>

    <div class="container recentlyAddedGifts">
        <div class="row">
            <div class="col-lg-2 latestProductsHeader">
                Recently Added<br>Products
            </div>

            <?php
                $getProductsInfo = "select prod_id, prod_category_id, prod_name, prod_price, prod_image FROM products ORDER by prod_id desc LIMIT 4;";
                $array = array();
                $query = mysqli_query($connection,$getProductsInfo);
                while ($row = mysqli_fetch_assoc($query)) {
                    $array[] = $row;
                }
                $myrow = $array;
                foreach ($myrow as $row) {
                    //breaking point
            ?>
            <div class="col-lg-2 recentlyAdded">
                <div style="border: 1px dashed white; padding: 5px; border-radius: 10px; margin-top: 10px; overflow: hidden;">
                    <img src="<?php echo $row['prod_image']?>" />
                </div>
                <strong class="titleName" style="font-size: 1em">
                    <?php echo $row['prod_name']?>
                </strong><br>
                <span style="color: var(--lightLime);">$</span> 
                <span style="color: white;"><?php echo $row['prod_price']?></span> 
            </div>
            <?php }?>
        </div>
    </div>
    
    <div class="container backGImage">
        The most special way to say you care
    </div>

    <?php include('pageFooter.php'); ?>

</body>
</html>