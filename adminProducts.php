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

<?php
    if (isset($_POST['addProductButton'])) {
        $prodCategory = $_POST['prodCategory'];
        $prodName = $_POST['txtProductName'];
        $prodDesc = $_POST['txtProdDesc'];
        $prodBrand = $_POST['txtProductBrand'];
        $prodPrice = $_POST['txtProductPrice'];

        $target_path = "Images/Products/";
        $target_path = $target_path . basename($_FILES['txtProductImage']['name']);
        
        $tempLocation = $_FILES['txtProductImage']['tmp_name'];

        if (move_uploaded_file($tempLocation, $target_path)) {

            $sql = "insert into products(prod_category_id , prod_name, prod_description, prod_price, prod_brand, prod_image) values('$prodCategory', '$prodName', '$prodDesc', '$prodPrice', '$prodBrand', '$target_path')";

            mysqli_query($connection,$sql);
           
            $selectCategory = "select * from categoryNames where category_id = '$prodCategory'";
            $result = mysqli_query($connection, $selectCategory);
            $row = mysqli_fetch_assoc($result);

            $prodTotal = $row['category_total_count'] + 1;
            $q = "update categoryNames SET category_total_count='".$prodTotal."' WHERE category_id= '".$prodCategory. "'";
            mysqli_query($connection, $q);

            echo '<script type="text/javascript">alert("Congratulations\nProduct Added!!");</script>';


        } else {
          echo "<script type='text/javascript'>alert('Something went wrong!!!');</script>";
        }
    }
?>

<?php
    
    if (isset($_GET['delete'])) {
        $prodID = $_GET['prodID'];  
        $catID = $_GET['catID'];

        $selectCategory2 = "select * from categoryNames where category_id = '$catID'";
        $result2 = mysqli_query($connection, $selectCategory2);
        $row2 = mysqli_fetch_assoc($result2);
        $prodTotal2 = $row2['category_total_count'] - 1;
        $q = "update categoryNames SET category_total_count='".$prodTotal2."' WHERE category_id= '".$catID. "'";
        mysqli_query($connection, $q);

        $deleteQuery = "delete from products where prod_id = '$prodID'";
        mysqli_query($connection, $deleteQuery);

        unlink($_GET['image']);

        echo "<SCRIPT type='text/javascript'>
                        window.location.replace(\"adminProducts.php\");
                        alert(\"Product Deleted \");
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

    <title>All Products | Admin | Gift Store</title>
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

        function mySearchFunction2() {
            var input, filter, table, tr, td, i, txtValue;

            input = document.getElementById("myInput2");
            filter = input.value.toUpperCase();

            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
        <h1> Products Database </h1>
        <input type="text" name="search" id="myInput" 
            onkeyup="mySearchFunction()" placeholder="Search Category"
            style="border-radius: 5px; margin-right: 10px; height: 35px; border: 1px solid var(--border); float: left; margin-left: 70px;">

            <input type="text" name="search" id="myInput2" 
            onkeyup="mySearchFunction2()" placeholder="Search Product"
            style="border-radius: 5px; margin-right: 10px; height: 35px; border: 1px solid var(--border); float: left; margin-left: 10px; margin-bottom: 10px;">

            <a href="#" class="addNewCategory" id="addNewProductButton" style="float: right; margin-right:65px">Add Product</a>

        <div class="categoryTable">

            <table class="table table-striped" id="myTable" style="width: 90%">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                <?php
                    $getProductsInfo = "select products.prod_id, products.prod_category_id, categoryNames.category_name, products.prod_name, products.prod_description, products.prod_price, products.prod_brand, products.prod_image FROM products, categoryNames WHERE products.prod_category_id = categoryNames.category_id;";
                    $array = array();
                    $query = mysqli_query($connection,$getProductsInfo);
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
                        <?php echo $row['category_name']?>
                    </td>
                    <td>
                        <?php echo $row['prod_name']?>
                    </td>
                    <td>
                        <?php echo $row['prod_description']?>
                    </td>
                    <td>

                        <span style="background-color: var(--border); color: var(--lightA); padding: 5px 8px; border-radius: 5px">
                            <span style="color: var(--lightLime);">$</span><?php echo $row['prod_price']?>
                        </span>
                    </td>
                    <td>
                        <?php echo $row['prod_brand']?>
                    </td>
                    <td>
                        <img src="<?php echo $row['prod_image']?>" style="width: 70px; height: 70px; border-radius: 5px; border: 1px solid var(--border);">
                    </td>
                    <td>
                        <!--
                        <a href="#" class="faIconStyle">
                                <i class="fa-solid fa-pencil"></i>
                        </a>
                        -->

                        <a href="?delete=1&prodID=<?php echo $row['prod_id']?>&catID=<?php echo $row['prod_category_id']?>&image=<?php echo $row['prod_image']?>" class="faIconStyle">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php $counter++; } ?>
            </table>
            
        </div>
    </div>

    <?php include('pageFooter.php'); ?>

    <!-- Add new Product Modal - Start -->
    <div id="newProductModal" class="modal">

      <!-- Modal content -->
      <div class="container modal-content">

        <div class="headerAdminLoginModal">
            <h3>Add Product</h3>
        </div>

        <div class="bodyAdminLoginModal">
            <form action="adminProducts.php" method="POST" enctype="multipart/form-data">
                <table style="width: 90%">
                    <tr>
                        <td>Product Category</td>
                        <td>
                            <select class="form-control" name="prodCategory" id="prodCategory" required style="border: 2px solid var(--border);">
                                <option value="" selected disabled>Select Category</option>

                                <?php
                                    $getCategoryNames = "SELECT * FROM categoryNames";
                                    $array = array();
                                    $query = mysqli_query($connection,$getCategoryNames);
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $array[] = $row;
                                    }
                                    $myrow = $array;
                                    foreach ($myrow as $row) {
                                        //breaking point
                                ?>
                                    <option value="<?php echo $row['category_id']; ?>">
                                        <?php echo $row['category_name']; ?>
                                    </option>
                                <?php }?>
                            </select>
                        </td>
                        <td>Product Name</td>
                        <td>
                            <input type="text" class="form-control" 
                                name="txtProductName" id="txtProductName" placeholder="Enter Product name" required />
                        </td>
                    </tr>

                    <tr>
                        <td rowspan="3">Product Description</td>
                        <td rowspan="3">
                            <textarea class="form-control" name="txtProdDesc" rows="7" cols="10" placeholder="Enter Product Description" required></textarea>
                        </td>

                        <td>
                            Product Brand
                        </td>
                        <td>
                            <input type="text" class="form-control" 
                                name="txtProductBrand" id="txtProductBrand" placeholder="Enter Product Brand" required />
                        </td>
                    </tr>

                    <tr>
                        <td>Product Price</td>
                        <td>
                            <input type="text" class="form-control" 
                                name="txtProductPrice" id="txtProductPrice" placeholder="Enter Product Price" required />
                        </td>
                    </tr>

                    <tr>
                        <td>Product Image</td>
                        <td>
                            <input type="file" class="form-control" 
                                name="txtProductImage" id="txtProductImage" />
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <input type="reset" value="Reset" class="btn adminLoginBtn">
                            <input type="submit" name="addProductButton" value="Add Product" class="btn adminLoginBtn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
      </div>      
    </div>
    <!-- Add new Product Modal - End -->

    <script type="text/javascript">
        // Get the modal
        var modal = document.getElementById("newProductModal");

        // Get the button that opens the modal
        var btn = document.getElementById("addNewProductButton");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>