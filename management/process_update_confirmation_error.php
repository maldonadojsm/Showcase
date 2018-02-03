<?php


ob_start(); // Initialize html buffer to process redirects


?>


<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') //Execute this process if the user has pressed the Return to Login Screen Button.
{
    if(isset($_POST['return']))
    {
        header("Location: http://localhost:8888/DatabaseProject/management/management_menu_db.php");
    }
}
?>
<body>
<div id="registration">
    <h2>An error has ocurred while processing the update!.</h2>

    <form method="post">
        <input name="return" type="submit" id=registration_btn value="Return to Main Menu" />
    </form>
</div>
</body>
</html>