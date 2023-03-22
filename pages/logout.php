<?php


if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header("Location: http://localhost/regit/pages/login.php");
    exit;
}

else {
    function logout()
    {


        session_destroy();

// Redirect to the login page:
        header("Location: http://localhost/regit/pages/login.php");
    }
}
