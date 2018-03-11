<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Instead of logging in each time, you can init the session if you previously saved it somewhere.

    //Login
    $instagram->login("username", "password");

    //Serialize the Session into Json
    $savedSession = $instagram->saveSession();

    //Store the $savedSession json string in a database or file etc
    echo $savedSession . "\n";

    //In a different script, Init from Saved Session json, instead of logging in again.
    //$savedSession would be from your database or a file etc
    $instagram->initFromSavedSession($savedSession);

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}