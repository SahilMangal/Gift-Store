<?php 
    include('connectivity.php'); 
?>

<?php 
    if (isset($_POST['adminLogin'])) {
        $adminEmail = $_POST['txtAdminEmail'];
        $adminPassword = $_POST['txtAdminPassword'];

        $selectQuery = "select * from adminTable where username = '$adminEmail' and password ='$adminPassword'";
        $implementQuery = mysqli_query($connection, $selectQuery);

        if (mysqli_fetch_array($implementQuery)) {
            
            $_SESSION["giftStoreAdmin"] = $adminEmail;

            $message = 'Welcome back!! ';
            echo "<SCRIPT type='text/javascript'> 
                alert('$message');
                window.location.replace(\"categoriesPage.php\");
                </SCRIPT>";
            
        } 
        else {
            $message = 'Sorry!! Looks like you are not an admin';

            echo "<SCRIPT type='text/javascript'> 
                alert('$message');
                window.location.replace(\"index.php\");
                </SCRIPT>";
        }

    }

    if (isset($_POST['customerLogin'])) {
        $customerEmailID = $_POST['txtCustomerEmail'];
        $customerPassword = $_POST['txtCustomerPassword'];

        $loginQuery = "SELECT * FROM customers WHERE email = '$customerEmailID' and password = '$customerPassword'";

        $implementQuery = mysqli_query($connection, $loginQuery);

        if (mysqli_fetch_array($implementQuery)) {
            
            $_SESSION["customer"] = $customerEmailID;

            $message = 'Login Successful';
            echo "<SCRIPT type='text/javascript'> 
                alert('$message');
                window.location.replace(\"index.php\");
                </SCRIPT>";
            
        } else {
            $message = 'Incorrect details :( \nPlease register first!';

            echo "<SCRIPT type='text/javascript'> 
                alert('$message');
                window.location.replace(\"signupForm.php\");
                </SCRIPT>";
        }
    }

?>

<div class="container pageHeaderStyle font_Georgia">
    <nav class="navbar navbar-expand-lg">

        <img src="Images/Logo/logoPNG.png">

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav" style="font-size: 20px;">
            <ul class="navbar-nav">

                <?php if (isset($_SESSION['giftStoreAdmin'])) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="categoriesPage.php">Categories</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="adminProducts.php">Products</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="customers.php">Customers</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="#">Orders</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php">Admin Logout</a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
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
                                <a href="homeCategories.php?category=<?php echo $row['category_id']; ?>" class="dropdown-item">
                                    <?php echo $row['category_name']; ?>
                                    <span style="background-color: var(--aHover); padding: 2px 5px; border-radius: 20px; color: var(--border);">
                                        <?php echo $row['category_total_count']; ?>
                                    </span>
                                </a>
                            <?php } ?>
                        </div>   
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="aboutUsPage.php">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="contactUsPage.php">Contact Us</a>
                    </li>
                    
                    <?php if(!isset($_SESSION["customer"])) { ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Signup/Login</a>
                        <div class="dropdown-menu">
                            <a href="signupForm.php" class="dropdown-item">Signup</a>
                            <a href="#" class="dropdown-item" id="customerLoginModalButton">Customer Login</a>
                            <a href="#" class="dropdown-item" id="adminLoginModalButton">Admin Login</a>
                        </div>   
                    </li>
                <?php } } ?>
                <?php if(isset($_SESSION["customer"])) { ?>
                    <!--<li class="nav-item active">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">My Orders</a>
                    </li>-->
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="cartModalButton">Cart</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </nav>    
</div>

<!-- Admin Login Modal - Start -->
<div id="adminLoginModal" class="modal">

  <!-- Modal content -->
  <div class="container modal-content">
    <div class="headerAdminLoginModal">
        <h3>Admin Login</h3>
    </div>
    <div class="bodyAdminLoginModal">
        <form method="post">
            <table>
                <tr>
                    <td>Email ID</td>
                    <td>
                        <input type="email" class="form-control" 
                            name="txtAdminEmail" id="txtAdminEmail" placeholder="Enter Email-Id" required />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" class="form-control" 
                            name="txtAdminPassword" id="txtAdminPassword" placeholder="Enter Password" required />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="adminLogin" value="Login now!" class="btn adminLoginBtn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
  </div>

</div>
<!-- Admin Login Modal - End -->

<!-- Customer Login Modal - Start -->
<div id="customerLoginModal" class="modal">

  <!-- Modal content -->
  <div class="container modal-content">
    <div class="headerAdminLoginModal">
        <h3>Customer Login</h3>
    </div>
    <div class="bodyAdminLoginModal">
        <form method="post">
            <table>
                <tr>
                    <td>Email ID</td>
                    <td>
                        <input type="email" class="form-control" 
                            name="txtCustomerEmail" id="txtCustomerEmail" placeholder="Enter Email-Id" required />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" class="form-control" 
                            name="txtCustomerPassword" id="txtCustomerPassword" placeholder="Enter Password" required />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="customerLogin" value="Login now!" class="btn adminLoginBtn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
  </div>
</div>
<!-- Customer Login Modal - End -->

<!-- Cart Modal - Start -->
<div id="cartModal" class="modal">

  <!-- Modal content -->
  <div class="container modal-content">
    <div class="headerAdminLoginModal">
        <h3>Cart</h3>
    </div>
    <div class="bodyAdminLoginModal">

        <?php
            $items = $_SESSION['giftStoreCart'];
            $cartitems = explode(",", $items);
        ?>
        <table border="1" style="border: 10px solid var(--border);">
            <tr style="background-color: var(--border); font-size: 1.2em;">
                <th>Product Image</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th></th>
            </tr>
            <?php 
                if (isset($_SESSION['giftStoreCart'])) {
                    $total = '';
                    $i=1;
                    $ItemTotal=0;
                    foreach ($cartitems as $key => $id) {
                        $sql = "Select * from products where prod_id = '$id'";
                        $res = mysqli_query($connection, $sql);
                        $r = mysqli_fetch_assoc($res);
                        $ItemTotal += $r['prod_price'];
            ?>

            <tr>
                <td>
                    <img src="<?php echo $r['prod_image']?>" style="width: 70px; height:70px ">
                </td>
                <td>
                    <?php echo $r['prod_name']?>
                </td>
                <td>
                    <?php echo $r['prod_brand']?>
                </td>
                <td>
                    <span style="background-color: var(--border); padding:5px 10px; border-radius: 5px">
                        <span style="color: var(--lightLime);">$</span><?php echo $r['prod_price']?>
                    </span>
                </td>
                <td>
                    <a href="#" style="color: var(--border); font-size:1.5em;">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </a>
                </td>
            </tr>

            <?php }  ?> 
                <tr style="background-color: var(--border); font-size: 1.5em">
                    <td colspan="3">
                        Total
                    </td>
                    <td>
                        <span style="color: var(--lightLime);">$</span><?php echo $ItemTotal;?>
                    </td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td colspan="4">
                        No Items added
                    </td>
                </tr>
            <?php } ?>
            
        </table>
    
    </div>
  </div>
</div>
<!-- Cart Modal - End -->

<script>
    // Get the modal
    var modal = document.getElementById("adminLoginModal");

    // Get the button that opens the modal
    var btn = document.getElementById("adminLoginModalButton");

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

<script>
    // Get the modal
    var modal1 = document.getElementById("customerLoginModal");

    // Get the button that opens the modal
    var btn1 = document.getElementById("customerLoginModalButton");

    // When the user clicks the button, open the modal 
    btn1.onclick = function() {
      modal1.style.display = "block";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event1) {
      if (event1.target == modal1) {
        modal1.style.display = "none";
      }
    }
</script>

<script>
    // Get the modal
    var modal2 = document.getElementById("cartModal");

    // Get the button that opens the modal
    var btn2 = document.getElementById("cartModalButton");

    // When the user clicks the button, open the modal 
    btn2.onclick = function() {
      modal2.style.display = "block";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event2) {
      if (event2.target == modal2) {
        modal2.style.display = "none";
      }
    }
</script>


