<?php
    include('connectivity.php');

    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION["giftStoreAdmin"])) {    
        echo "<SCRIPT type='text/javascript'> 
                window.location.replace(\"categoriesPage.php\");
                </SCRIPT>";
    }

    if (!isset($_SESSION['customer'])) {
        echo "<SCRIPT type='text/javascript'> 
                alert('please login first');
                window.location.replace(\"index.php\");
                </SCRIPT>";
    }
    
?>

<?php

    if(isset($_GET['addToCartProdId']) & !empty($_GET['addToCartProdId'])) {

        if (isset($_SESSION['giftStoreCart']) & !empty($_SESSION['giftStoreCart'])) {
            $items = $_SESSION['giftStoreCart'];
            $cartitems = explode(",", $items);

            if (in_array($_GET['addToCartProdId'], $cartitems)) {
                $message = 'Already in your cart';
                echo "<SCRIPT type='text/javascript'> 
                        alert('$message');
                        window.location.replace(\"index.php\");
                        </SCRIPT>";
            } else {
                $items .= "," . $_GET['addToCartProdId'];
                $_SESSION['giftStoreCart'] = $items;
                $message = 'Item added in your cart';
                echo "<SCRIPT type='text/javascript'> 
                        alert('$message');
                        window.location.replace(\"index.php\");
                        </SCRIPT>";
            }
        } else {
            $items = $_GET['addToCartProdId'];
            $_SESSION['giftStoreCart'] = $items;
            $message = 'item added in your cart';
            echo "<SCRIPT type='text/javascript'> 
                        alert('$message');
                        window.location.replace(\"index.php\");
                        </SCRIPT>";
        }
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

    <title>Product Description | Gift Store</title>
    <link rel="icon" type="image/x-icon" href="Images/Logo/fav-icon.png">
    <script src="Javascript/javascript.js" type="text/javascript"></script>
    <script src="Javascript/slideShow.js" type="text/javascript"></script>
    <script src="Javascript/signupScript.js" type="text/javascript"></script>
    <script src="Javascript/contactUsValidation.js" type="text/javascript"></script>

    <!-- eye symbol -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- CSS  -->
    <link rel="stylesheet" href="Stylesheet/base.css">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <link rel="stylesheet" href="Stylesheet/signupStyle.css">   
    <link rel="stylesheet" href="Stylesheet/pageHeaderStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageFooterStylesheet.css">


</head>
<body style="background-image: url('Images/tile.jpeg'); background-attachment: fixed;">

    <?php include('pageHeader.php'); ?>

    <div class="container formBody">

        <?php
            $prodID = $_GET['prod'];
            $catID = $_GET['cat'];
            $selectQuery = "SELECT * FROM products WHERE prod_id = '$prodID' AND prod_category_id = '$catID'";
            $result = mysqli_query($connection, $selectQuery);
            $row = mysqli_fetch_assoc($result);
        ?>
        <div class="row">
            <div class="col-lg-5 div leftDiv">
                <img src="<?php echo $row['prod_image']; ?>" id="signup1Image" onmouseover="imageHighlight()" onmouseout="revertHighlight()">
            </div>
            <div class="col-lg-6 div rightDiv">
                <strong class="header">
                    <?php echo $row['prod_name']; ?>
                </strong><hr>
                <br>

                <div style="font-family: Chalkduster">
                    <h4>
                        Brand: <?php echo $row['prod_brand']; ?>
                    </h4>
                    <br/><br/>
                    
                    <h4>Description:</h4>
                    <h4><?php echo $row['prod_description']; ?></h4>
                    <br><br>

                    <h4>Price:</h4>
                    <span style="background-color: var(--lightBrown); padding: 10px 20px; color: white; border-radius: 5px; border: 1px solid black;">
                        <span style="color: var(--lightLime);">$</span>
                        <?php echo $row['prod_price']; ?>
                    </span>
                    <span class="addToCart">
                        <a href="?addToCartProdId=<?php echo $row['prod_id']; ?>">Add to Cart</a>
                    </span>
                    
                </div>

            </div>
        </div>
    </div>

    <?php include('pageFooter.php'); ?>

</body>
</html>