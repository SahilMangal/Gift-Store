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

    if (isset($_POST['deleteCategoryButton'])) {
        $categoryId = $_POST['txtCategoryId'];
        $pTotalCount = $_POST['txtNoOfProducts'];
        

        if ($pTotalCount == 0) {
            $query = "delete from categoryNames where category_id = $categoryId";
            mysqli_query($connection, $query);
            $message = 'Category Deleted';
            
            echo "<SCRIPT type='text/javascript'> alert('$message');
                    window.location.replace(\"categoriesPage.php\");
                    </SCRIPT>";
        } else {
            $message = 'You have to delete products first!';
            echo "<SCRIPT type='text/javascript'> alert('$message');
                    window.location.replace(\"categoriesPage.php\");
                    </SCRIPT>";
        }
    }

    if (isset($_POST['addCategoryButton'])) {

        $cName = $_POST['txtCategoryName'];

        $insertCategory = "insert into categoryNames (category_name) values ('$cName')";
        mysqli_query($connection, $insertCategory);
        $message = 'Category Added!!';
            
        echo "<SCRIPT type='text/javascript'> alert('$message');
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
        <h1> Categories </h1>
        <input type="text" name="search" id="myInput" 
            onkeyup="mySearchFunction()" placeholder="Search Category..."
            style="border-radius: 5px; margin-right: 10px; height: 35px; border: 1px solid var(--border);">
        <a href="#" class="addNewCategory" id="addNewCategoryButton">Add new Category</a>

        <div class="categoryTable">

            <table class="table table-striped" id="myTable">
                <tr>
                    <th scope="col">S. no</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Number of Products</th>
                    <th scope="col">Action</th>
                </tr>
                <?php
                    $getCategoryInfo = "select * FROM categoryNames order by category_id";
                    $array = array();
                    $query = mysqli_query($connection,$getCategoryInfo);
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
                        <?php echo $row['category_total_count']?>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtCategoryId" value="<?php echo $row['category_id']?>">
                            <input type="hidden" name="txtNoOfProducts" value="<?php echo $row['category_total_count']?>">
                            <input type="submit" name="deleteCategoryButton" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
                <?php $counter++; } ?>
            </table>
            
        </div>
    </div>

    <?php include('pageFooter.php'); ?>

    <!-- Add new Category Modal - Start -->
    <div id="newCategoryModal" class="modal">

      <!-- Modal content -->
      <div class="container modal-content">

        <div class="headerAdminLoginModal">
            <h3>Add new Category</h3>
        </div>

        <div class="bodyAdminLoginModal">
            <form method="post">
                <table>
                    <tr>
                        <td>Category Name</td>
                        <td>
                            <input type="text" class="form-control" 
                                name="txtCategoryName" id="txtCategoryName" placeholder="Enter Category name..." required />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="addCategoryButton" value="Add" class="btn adminLoginBtn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
      </div>      
    </div>
    <!-- Add new Category Modal - End -->

    <script type="text/javascript">
        // Get the modal
        var modal = document.getElementById("newCategoryModal");

        // Get the button that opens the modal
        var btn = document.getElementById("addNewCategoryButton");

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