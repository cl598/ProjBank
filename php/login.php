<?php
if(isset($_POST["login"])){
    $email = null;
    $password = null;
    $isValid = true;

    if(isset($_POST["email"])){
        $email = $_POST["email"];
    }if(isset($_POST["password"])){
        $password = $_POST["password"];
    }

    if(!isset($email) || !isset($password)){
        $isValid = false;
    }if(!strpos($email, "@")){
        $isValid = false;
        echo "<br>Email is invalid<br>";
    }if($isValid){
        $password_hash_from_db = '';

        if(password_verify($password, $password_hash_from_db)){
            echo "<br>Success! You've logged in!<br>";
        }else{
            echo "<br>Password is invalid<br>";
        }

    }else{
        echo "There was a validation issue";
    }
}