<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Set the Proxy and Port
    $instagram->setProxy("127.0.0.1:8888");

    //Your Proxy might need Username and Password
    //$instagram->setProxy("127.0.0.1:8080", "username", "password");

    //Enable/Disable SSL Verification (Testing with Charles Proxy etc)
    $instagram->setVerifyPeer(false);

    //Login
    $instagram->login("username", "password");

    //todo: Do something! :)

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}