<?php
//Captures parameters entered by client in login screen
$email = $_POST['email'];
$email=$mysqli->escape_string($_POST['email']);
//Queries and stores the email address found in the database into variable $result
$result = $mysqli->query("SELECT * FROM client WHERE email='$_POST[email]'");
if ( $result->num_rows == 0 ) //If email address paramater hasn't appeared within the Client Table
{ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("Location: http://localhost:8888/DatabaseProject/authenticate/username_error.php"); //Send him to some page dispalying a message. West: I haven't created a page here.
    // Should essentially redirect to the login screen. I tried building an html page displaying some message and
    //then automatically sending him  after a  delay of 3-5 seconds delay but php bypasses the message and processes the delay.
    //The only solution I found was to provide some sort button within that page (Return to Login Screen) that manually redirects
    //him to the login screen.
}
else { // User exists
    $user = $result->fetch_assoc();//Stores the entire record related to the email address provided in the login screen
    if (password_verify($_POST['password'],$user['password']) )//Compared entered password with the hashed PW in Client Table
    {
        if($user['email']=="admin@gmail.com")//Redirects to the management portion of the application
        {
            header("Location: http://localhost:8888/DatabaseProject/management/management_menu_db.php"); // Send him to the admin pages
            $_SESSION['logged_in'] = true;
        }
        else
        {
            //Initializes session variables related to the information contained in the $user variable.
            //We'll use these variables to filter account information related to this user.
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['id_client']=$user['idclient'];
            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;
            header("Location: http://localhost:8888/DatabaseProject/authenticate/menu_db.php"); //Send him to client main menu
        }
    }
    else
    {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("Location: http://localhost:8888/DatabaseProject/authenticate/password_error.php"); //Send him to login screen. West: I haven't built the page
    }
}
