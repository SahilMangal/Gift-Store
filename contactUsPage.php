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
    
?>

<?php
    if (isset($_POST['submitMessage'])) {
        $firstName = $_POST['txtFirstName'];
        $lastName = $_POST['txtLastName'];
        $emailID = $_POST['txtEmailID'];
        $message = $_POST['txtMessage'];

        $insertIntoContactTableQuery = "INSERT INTO contactUs(firstName, lastName, emailID, message) VALUES ('$firstName', '$lastName', '$emailID', '$message')";

        mysqli_query($connection, $insertIntoContactTableQuery);
        $message = 'Message sent!';
        
        echo "<SCRIPT type='text/javascript'> alert('$message');
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

    <title>Contact Us | Gift Store</title>
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

        <div class="row">
            <div class="col-lg-5 div leftDiv">
                <img src="Images/signup1.jpeg" id="signup1Image" onmouseover="imageHighlight()" onmouseout="revertHighlight()">
            </div>
            <div class="col-lg-6 div rightDiv">
                <strong class="header">
                    Contact Us
                </strong><hr>
                <br>

                <form method="post">
                    <table>
                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>First Name
                                </div>
                            </td>
                            <td>
                                <input type="text" name="txtFirstName" id="txtFirstName" class="form-control textBox" placeholder="Enter your first name here..." required>
                                <p style="padding-left: 10px; color: red" id="firstNameCheck">
                                    **First Name is missing
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Last Name
                                </div>
                            </td>
                            <td>
                                <input type="text" name="txtLastName" id="txtLastName" class="form-control textBox" placeholder="Enter your last name here..." required>
                                <p style="padding-left: 10px; color: red" id="lastNameCheck">
                                    **Last Name is missing
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Email ID
                                </div>
                            </td>
                            <td>
                                <input type="email" name="txtEmailID" id="txtEmailID" class="form-control textBox" placeholder="Enter your email ID here..." oninput="validateEmail('txtEmailID')" value="<?php if(isset($_SESSION['customer'])) { echo $_SESSION['customer'];}?>" required>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Message
                                </div>
                            </td>
                            <td>
                                <textarea name="txtMessage" id="txtMessage" class="form-control textBox" rows="5" placeholder="Type your message here..."></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="reset" name="resetButton" value="Reset" class="btn btn-secondary" style="margin-top:40px; float: right;">
                            </td>
                            <td>
                                <input type="submit" name="submitMessage" value="Send Message" class="btn btn-success" style="width: 100%; margin-left: 10px; margin-top:40px">
                                
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
    </div>

    <?php include('pageFooter.php'); ?>

</body>
</html>