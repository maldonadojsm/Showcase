<?php
$_SESSION['email']=$_POST['email'];
$_SESSION['first_name']=$_POST['firstname'];
$_SESSION['last_name']=$_POST['lastname'];
$_SESSION['business_name']=$_POST['businessname'];

//Stores the information provided by a new user in the registration page. Escape string protects the application
//and the database from SQL injections
$first_name=$mysqli->escape_string($_POST['firstname']);
$last_name=$mysqli->escape_string($_POST['lastname']);
$business_name=$mysqli->escape_string($_POST['businessname']);
$email=$mysqli->escape_string($_POST['email']);
$telephone=$mysqli->escape_string($_POST['telephone']);

//Builds a hash password based on the password provided by the new user.
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

//Query to process the insertion of the new user's details into the Client table.
$result=$mysqli->query("SELECT * from client where email='$email'") or die($mysqli->error());
if($result->num_rows >0) // if there is a one row within the table that has the same email..// session ID
{
    $_SESSION['message']='A user with this email already exists';
    header("Location: http:/localhost:8888/DatabaseProject/authenticate/registration_fail.php");
}
else {
    $sql = "INSERT INTO client(first_name,last_name,business_name,email,telephone,password,hash)"
        ."VALUES('$first_name','$last_name','$business_name','$email','$telephone','$password','$hash')";

    if($mysqli->query($sql))
    {
        header("location: register_confirm.php");//Sends the user to a new page displaying a confirmation message
    }
    else
    {
        header("Location: register_db.php");//West: I haven't created a page here displaying a message.
        //Exact structure to those oI mentioned in the process_login.php script
        echo "Registration Failed! ";
    }
}
