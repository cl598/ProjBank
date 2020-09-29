<?php
if(isset($_POST["register"])){

    $email = null;
    $password = null;
    $repeatpw = null;

    if(isset($_POST["email"])){
        $email = $_POST["email"];
    }if(isset($_POST["password"])){
        $password = $_POST["password"];
    }if(isset($_POST["confirm"])){
        $repeatpw = $_POST["repeat-pw"];
    }

    $isValid = true;

    if($password == $repeatpw){
        echo "Passwords match!<br>";
    } else{
        echo "Passwords do not match!<br>";
        $isValid = false;
    }

    if(!isset($email) || !isset($password) || !isset($repeatpw)){
        $isValid = false;
    }
}
