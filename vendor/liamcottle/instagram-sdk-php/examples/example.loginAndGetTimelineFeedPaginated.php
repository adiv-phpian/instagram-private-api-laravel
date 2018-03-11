<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Login
    $instagram->login("username", "password");

    //Get TimelineFeed
    $timelineFeed = $instagram->getTimelineFeed();

    echo "Page 1\n";

    foreach($timelineFeed->getItems() as $timelineFeedItem){

        //Grab a list of Images for this Post (different sizes)
        $images = $timelineFeedItem->getImageVersions2()->getCandidates();

        //Grab the URL of the first Photo in the list of Images for this Post
        $photoUrl = $images[0]->getUrl();

        //Just echo it hey
        echo sprintf("Media Url: %s\n", $photoUrl);

    }

    //This will be null if there are no more pages.
    //The next page might be empty, but that request wont return a nextMaxId
    $nextMaxId = $timelineFeed->getNextMaxId();

    //We have another page of Items
    if($nextMaxId != null){

        echo sprintf("Fetching next Page: %s\n", $nextMaxId);

        //Get the next page.
        $timelineFeed = $instagram->getTimelineFeed($nextMaxId);

        //Now you have the next page.
        //You could do the same as above, and echo the media url.
        //... or do something more exciting? :)

        echo "Page 2\n";

        foreach($timelineFeed->getItems() as $timelineFeedItem){

            //Grab a list of Images for this Post (different sizes)
            $images = $timelineFeedItem->getImageVersions2()->getCandidates();

            //Grab the URL of the first Photo in the list of Images for this Post
            $photoUrl = $images[0]->getUrl();

            //Just echo it hey
            echo sprintf("Media Url: %s\n", $photoUrl);

        }

    }

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}