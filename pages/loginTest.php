<?php
if(session_status() === PHP_SESSION_NONE) session_start();

//SELECT user.id,employee.user_id,employee.company_id, user.display_name,user_name, password FROM user INNER JOIN employee on user.id = employee.user_id INNER JOIN company on employee.company_id = company.id WHERE user_name = 'Admin' and user.deleted = 0

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
//if ( !isset($_POST['username'], $_POST['password']) ) {
//// Could not get the data that should have been sent.
//    //exit('Please fill both the username and password fields!');
//}


// preparing the SQL statement will prevent SQL injection.

//if ($stmt = $con->prepare('SELECT user.id,employee.user_id,employee.company_id, user.display_name,user_name FROM user INNER JOIN employee on user.id = employee.user_id INNER JOIN company on employee.company_id = company.id WHERE user_name = ? and user.deleted = 0')) {
//
//$stmt->bind_param('s', $_POST['username']);
//$stmt->execute();
//
//$stmt->store_result();
//
//if ($stmt->num_rows > 0) {
//    $stmt->bind_result($userID,$employeeID,$companyID,$userDisplayName, $username);
//    $stmt->fetch();
//    $_SESSION['userID'] = $userID;
//    $_SESSION['employeeID'] = $employeeID;
//    $_SESSION['userDisplayName'] = $userDisplayName;
//    $_SESSION['companyID'] = $companyID;
//}
//else
//{
//    return 0;
//}

    if ($stmt = $con->prepare('SELECT id,user_name, password FROM user WHERE user_name = ?')) {

        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result( $id,$username, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.

            if (password_verify($_POST['password'], $password)) {

                // Verification completed, User is logged in
                // Create sessions
                //session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['id'] = $id;

                header("Location: http://localhost/regit/pages/selecteerBedrijf.php");
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




//}




?>
