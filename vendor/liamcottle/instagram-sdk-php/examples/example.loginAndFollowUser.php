<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Login
    $instagram->login("username", "password");

    //Find User by Username
    $user = $instagram->getUserByUsername("liamcarncottle");

    //Follow the User
    $instagram->followUser($user);

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}