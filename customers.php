<?php 
    include('connectivity.php'); 

    session_start();
    
    if (!isset($_SESSION["giftStoreAdmin"])) {    
        echo "<SCRIPT type='text/javascript'> 
                alert('You need to login firse');
                window.location.replace(\"index.php\");
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

    <title>All Customers | Admin | Gift Store</title>
    <link rel="icon" type="image/x-icon" href="Images/Logo/fav-icon.png">
    <script src="Javascript/javascript.js" type="text/javascript"></script>
    <script src="Javascript/slideShow.js" type="text/javascript"></script>

    <!-- CSS  -->
    <link rel="stylesheet" href="Stylesheet/base.css">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageHeaderStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageFooterStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/categoriesPageStyle.css">

    <style type="text/css">
        .sliderShowContainer .slider {
            display: none;
        }
    </style>

    <script type="text/javascript">
        function mySearchFunction() {
            var input, filter, table, tr, td, i, txtValue;

            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();

            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</head>
<body style="background-image: url('Images/tile.jpeg'); background-attachment: fixed;">

    <?php include('pageHeader.php'); ?>

    <div class="container categoriesPageBody">
        <h1> Customers Database </h1>
        <input type="text" name="search" id="myInput" 
            onkeyup="mySearchFunction()" placeholder="Search with first name"
            style="border-radius: 5px; margin-right: 10px; height: 35px; border: 1px solid var(--border);">

        <div class="categoryTable">

            <table class="table table-striped" id="myTable">
                <tr>
                    <th scope="col">S. no</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email ID</th>
                    <th scope="col">Mobile no.</th>
                    <th scope="col">Account Creation date</th>
                </tr>
                <?php
                    $getCustomerInfo = "select * FROM customers order by customer_id";
                    $array = array();
                    $query = mysqli_query($connection,$getCustomerInfo);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $array[] = $row;
                    }
                    $myrow = $array;
                    $counter = 1;
                    foreach ($myrow as $row) {
                        //breaking point
                ?>
                <tr>
                    <th scope="row" style="text-align: center;">
                        <?php echo $counter ?>
                    </th>
                    <td>
                        <?php echo $row['first_name']?>
                    </td>
                    <td>
                        <?php echo $row['last_naem']?>
                    </td>
                    <td>
                        <?php echo $row['email']?>
                    </td>
                    <td>
                        <?php echo $row['mobile']?>
                    </td>
                    <td>
                        <?php echo $row['account_created_date']?>
                    </td>
                </tr>
                <?php $counter++; } ?>
            </table>
            
        </div>
    </div>

    <?php include('pageFooter.php'); ?>
</body>
</html>