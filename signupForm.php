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

    if (isset($_POST["submit"])) {

        $firstName = $_POST['txtFirstName'];
        $lastName = $_POST['txtLastName'];
        $emailID = $_POST['txtEmailID'];
        $mobile = $_POST['txtMobile'];
        $password = $_POST['txtPassword'];
        $cPassword = $_POST['txtConfirmPassword'];
        $accountCreatedDate = date("Y-m-d");

        if ($password == $cPassword) {
            $insertQuery = "insert into customers (first_name, last_naem, email, mobile, password, account_created_date) VALUES ('$firstName', '$lastName', '$emailID', '$mobile', '$password', '$accountCreatedDate')";

            mysqli_query($connection, $insertQuery);
            $message = 'Registration Successful';
        
            echo "<SCRIPT type='text/javascript'> alert('$message');
                    window.location.replace(\"signupForm.php\");
                    </SCRIPT>";

        } else {
            $message = 'Password Mismatch';
            echo "<SCRIPT type='text/javascript'> alert('$message');
                    window.location.replace(\"signupForm.php\");
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

    <title>Signup | Gift Store</title>
    <link rel="icon" type="image/x-icon" href="Images/Logo/fav-icon.png">
    <script src="Javascript/javascript.js" type="text/javascript"></script>
    <script src="Javascript/slideShow.js" type="text/javascript"></script>
    <script src="Javascript/signupScript.js" type="text/javascript"></script>

    <!-- eye symbol -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- CSS  -->
    <link rel="stylesheet" href="Stylesheet/base.css">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <link rel="stylesheet" href="Stylesheet/signupStyle.css">   
    <link rel="stylesheet" href="Stylesheet/pageHeaderStylesheet.css">
    <link rel="stylesheet" href="Stylesheet/pageFooterStylesheet.css">


    <script type="text/javascript">
        function onlyAlphabet(fname) {
            var regEx = /^[A-Za-z]+$/;

            if (fname.match(regEx)) {
                return true;
            } else {
                return false;
            }
        }

        function validateTextbox(id, validate_name) {
            var x = document.getElementById(id).value.trim();
            isValid = onlyAlphabet(x);
            if (!isValid) {
                document.getElementById(id).style.backgroundColor = "#EF5350";
                document.getElementById(id).style.color = "white";
            } else {
                document.getElementById(id).style.backgroundColor = "white";
                document.getElementById(id).style.color = "black";
            }
        }

        function onlyDigit(number) {
            
            var regEx = /[^0-9]/g;
            if (number.match(regEx)) {

                return true;
            } else {

                return false;
            }
        }

        function validateNumberTextbox(id, validate_name) {
            
            var x = document.getElementById(id).value;
            isValid = onlyDigit(x);
            if (isValid) {
                document.getElementById(id).style.backgroundColor = "#EF5350";
                document.getElementById(id).style.color = "white";
            } else {
                document.getElementById(id).style.backgroundColor = "white";
                document.getElementById(id).style.color = "black";
            }

        }

        function validateEmail(id) {
            var x = document.getElementById(id).value;
            var validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if (x.match(validRegex)) {
                document.getElementById(id).style.backgroundColor = "white";
                document.getElementById(id).style.color = "black";
            } else {
                document.getElementById(id).style.backgroundColor = "#EF5350";
                document.getElementById(id).style.color = "white";
                
            }
        }

        function validatePassword(p_id, c_id) {

            var password = document.getElementById(p_id).value;
            var confirmPassword = document.getElementById(c_id).value;

            if (password == confirmPassword) {
                document.getElementById(c_id).style.backgroundColor = "white";
                document.getElementById(c_id).style.color = "black";
            } else {
                document.getElementById(c_id).style.backgroundColor = "#EF5350";
                document.getElementById(c_id).style.color = "white";
            }
        }

        function togglePassword(p_id) {

            var x = document.getElementById(p_id);

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>

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
                    Signup Form
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
                                <input type="text" name="txtFirstName" id="txtFirstName" class="form-control textBox" 
                                    oninput="validateTextbox('txtFirstName', 'txtFirstNameErrorMessage')" required>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Last Name
                                </div>
                            </td>
                            <td>
                                <input type="text" name="txtLastName" id="txtLastName" class="form-control textBox"
                                    oninput="validateTextbox('txtLastName', 'txtLastNameErrorMessage')" required>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Email ID
                                </div>
                            </td>
                            <td>
                                <input type="email" name="txtEmailID" id="txtEmailID" class="form-control textBox"
                                    oninput="validateEmail('txtEmailID')" required>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Mobile No
                                </div>
                            </td>
                            <td>
                                <input type="text" name="txtMobile" id="txtMobile" class="form-control textBox" 
                                    oninput="validateNumberTextbox('txtMobile', 'mobleErrorMessage')" required>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Password
                                </div>
                            </td>
                            <td>
                                <input type="password" name="txtPassword" id="txtPassword" class="form-control textBox" required>
                            </td>

                        </tr>

                        <tr>
                            <td></td>
                            <td style="font-family: Ayuthaya;">
                                <input type="checkbox" class="checkBoxDesign" name="togglepassword" onclick="togglePassword('txtPassword')">
                                    Show Password
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="headingNames">
                                    <sup style="color: var(--lightLime);">*</sup>Confirm<br>Password
                                </div>
                            </td>
                            <td>
                                <input type="password" name="txtConfirmPassword" id="txtConfirmPassword"
                                    oninput="validatePassword('txtPassword', 'txtConfirmPassword')" class="form-control textBox" required>
                                
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="reset" name="resetButton" value="Reset" class="btn btn-secondary" style="margin-top:40px; float: right;">
                            </td>
                            <td>
                                <input type="submit" name="submit" value="Register" class="btn btn-success" style="width: 100%; margin-left: 10px; margin-top:40px">
                                
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