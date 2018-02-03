<?php
//This page is used to enter information for the creation of a new session within the application.
// The page will provide a form prompting the manager to enter an hour interval, date and number of reservation spots.
ob_start();
session_start();//Initialises buffer.
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')  //Process this action if the user has pressed the "Create Session" Button
{
    if (isset($_POST['create_session'])) {
        require 'process_session_creation.php'; //The rest of the session creation process will occur within this file.
        //Consult its content for further explanations of the procedure.
    }
}
?>
<div id="registration">
    <form action="" method="post">
            <h2>Session Creator</h2>
            <label for="f_n">Time (00:00H-00:00H Format):</label>
            <input type="text" name="hour" id="f_n" required>


            <label for="l_n">Date (MM/DD/YY Format):</label>
            <input type="text" name="date" id="l_n" required>


            <label for="b_n">Spots(1-8):</label>
            <input type="text" name="spots" id="b_n" required>

            <input name="create_session" type="submit" id="registration_btn" value="Create Session">
    </form>
</div>
</body>
</html>