<?php 
    include('connectivity.php'); 

    session_start();
    
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

    <title>About Us | Gift Store</title>
    <link rel="icon" type="image/x-icon" href="Images/Logo/fav-icon.png">
    <script src="Javascript/javascript.js" type="text/javascript"></script>
    <script src="Javascript/slideShow.js" type="text/javascript"></script>

    <!-- CSS  -->
    <link rel="stylesheet" href="Stylesheet/base.css">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageHeaderStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageFooterStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/categoriesPageStyle.css">

</head>
<body style="background-image: url('Images/tile.jpeg'); background-attachment: fixed;">

    <?php include('pageHeader.php'); ?>

    <div class="container categoriesPageBody">
        <h1> Team Members </h1>
        <div class="categoryTable">

            <table class="table table-striped" id="myTable" style="margin-bottom: 70px;">
                <tr>
                    <th scope="col">Team Member Name</th>
                    <th scope="col">Team Member Student ID</th>
                    <th scope="col">Team Member Student E-mail</th>
                </tr>
                <tr>
                    <td>
                        <img src="Images/Icon/img1.png" style="width: 50px; height: 60px; border-radius: 5px; border: 2px solid var(--border);">
                        Chetan Rawat
                    </td>
                    <td>
                        C0820033
                    </td>
                    <td>
                        c0820033@mylambton.ca
                    </td>
                </tr>

                <tr>
                    <td>
                        <img src="Images/Icon/img2.png" style="width: 50px; height: 60px; border-radius: 5px; border: 2px solid var(--border);">
                        Deepati Saraff
                    </td>
                    <td>
                        C0848121
                    </td>
                    <td>
                        c0848121@mylambton.ca
                    </td>
                </tr>

                <tr>
                    <td>
                        <img src="Images/Icon/img1.png" style="width: 50px; height: 60px; border-radius: 5px; border: 2px solid var(--border);">
                        Jibin Thomas
                    </td>
                    <td>
                        C0855684
                    </td>
                    <td>
                        c0855684@mylambton.ca
                    </td>
                </tr>

                <tr>
                    <td>
                        <img src="Images/Icon/img1.png" style="width: 50px; height: 60px; border-radius: 5px; border: 2px solid var(--border);">
                        Sahil Mangal
                    </td>
                    <td>
                        C0854050
                    </td>
                    <td>
                        c0854050@mylambton.ca
                    </td>
                </tr>
            </table>
            
        </div>
    </div>

    <?php include('pageFooter.php'); ?>

</body>
</html>