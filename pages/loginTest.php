<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'regit';
$port = 3306;
// Try and connect to DB.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME,$port);
if ( mysqli_connect_errno() ) {
// If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
// Could not get the data that should have been sent.
    //exit('Please fill both the username and password fields!');
}


// preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id,user_name, password,clearence_id FROM user WHERE user_name = ?')) {

    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result( $id,$username, $password,$clearance_id);
        $stmt->fetch();
        // Account exists, now we verify the password.

        if (password_verify($_POST['password'], $password)) {
            //if ($_POST['password'] === $password) {

            //$hash = password_hash($password, PASSWORD_DEFAULT);

            //$query = "UPDATE `user` SET `password` = ? WHERE `id` = ?";
            //$stmt = $con->prepare($query);
            //$stmt->bind_param("si", $hash, $id);
            //$stmt->execute();

            // Verification completed, User is logged in
            // Create sessions
            //session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $id;
            $_SESSION['clearence_id'] = $clearance_id;
            header("Location: http://localhost/regit/pages/index.php");
            exit();
            //echo 'Welcome ' . $_SESSION['username'] . '!';
        }

        else {
            // Incorrect password
            //echo 'Invalid Credentials!';

        }
    }
    else {
        // Incorrect username
        //echo 'Invalid Credentials!';

    }


    $stmt->close();
}
?>
