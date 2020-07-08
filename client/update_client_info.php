<?php
//If the client has pressed "Update" in the account summary page, such page will redirect him to this page; functioning
// very similarly to the registration page.
ob_start();// Initialize Buffer
session_start(); //Allows us to use session variables.
//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//This query will allow us to accurately insert the new information provided by the user.
$user=$_SESSION['id_client'];
$data=$mysqli->query("SELECT * FROM client WHERE idclient='$user'");

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Account Summary</title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['update']))
    {
        $_SESSION['fn']=$_POST['firstname'];
        $_SESSION['ln']=$_POST['lastname'];
        $_SESSION['em']=$_POST['email'];
        $_SESSION['tele']=$_POST['telephone'];
        require 'process_update.php';
    }
}
?>
<body>
<div id="registration" >
    <h2> Update </h2>
        <?php  while($user=mysqli_fetch_array($data)){?>
            <form method="post">
                <label for="f_n">First Name:</label>
                <input type="text" name="firstname"  required value="<?php echo $user['first_name'] ?>">

                <label for="f_n">Last Name:</label>
                <input type="text" name="lastname"  required value="<?php echo $user['last_name'] ?>">

                <label for="f_n">Email:</label>
                <input type="text" name="email"  required value="<?php echo $user['email'] ?>">

                <label for="f_n">Telephone:</label>
                <input type="tel" name="telephone"  required value="<?php echo $user['telephone'] ?>">


                <input name="update" type="submit" id="registration_btn" value="Update">
            </form>
        <?php }?>
</div>
</body>
</html>