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
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Signup/Login</a>
                        <div class="dropdown-menu">
                            <a href="signupForm.php" class="dropdown-item">Signup</a>
                            <a href="#" class="dropdown-item">Customer Login</a>
                            <a href="#" class="dropdown-item" id="adminLoginModalButton">Admin Login</a>
                        </div>   
                    </li>
                <?php }?>

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

