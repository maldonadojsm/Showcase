<?php
//This is the registration screen that the user will use to enter his details to build an account for the application.


ob_start();//Initialize Buffer
//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['register'])) {
        require 'process_regist.php';
    }
}
?>
<div id="registration">
    <form action="http://localhost:8888/DatabaseProject/authenticate/register_db_mysqli.php" method="post">
            <h2>Registration</h2>
            <label for="f_n">First Name:</label>
            <input type="text" name="firstname" id="f_n" required>


            <label for="l_n">Last Name:</label>
            <input type="text" name="lastname" id="l_n" required>


            <label for="b_n">Business Name:</label>
            <input type="text" name="businessname" id="b_n" required>


            <label for="t_n">Telephone Number (Include International Code):</label>
            <input type="tel" name="telephone" id="t_n" required>

            <label for="e_a">Email Address:</label>
            <input type="email" name="email" id="e_a" required>

            <label for="pwd">Password:</label>
            <input type="password" name="password" id="pwd" required>

            <input name="register" type="submit" id="registration_btn" value="Register">
    </form>
</div>
</body>
</html>