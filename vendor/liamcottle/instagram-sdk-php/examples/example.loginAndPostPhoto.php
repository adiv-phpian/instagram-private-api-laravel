<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Login
    $instagram->login("username", "password");

    //Upload and Post Photo
    $result = $instagram->postPhoto("/Users/liamcottle/Desktop/photo.jpg", "Caption");

    //Media from Result
    $media = $result->getMedia();

    //Get the Images on Instagram for this Uploaded Media
    $images = $media->getImageVersions2()->getCandidates();

    foreach($images as $image){
        echo sprintf("Image Version: %sx%s %s\n", $image->getWidth(), $image->getHeight(), $image->getUrl());
    }

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}