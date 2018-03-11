<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Login
    $instagram->login("username", "password");

    //Find User by Username
    $user = $instagram->getUserByUsername("liamcarncottle");

    //Get Feed of User by Id
    $userFeed = $instagram->getUserFeed($user);

    //Iterate over Items in Feed
    foreach($userFeed->getItems() as $feedItem){

        //User Object, (who posted this)
        $user = $feedItem->getUser();

        //Caption Object
        $caption = $feedItem->getCaption();

        //How many Likes?
        $likeCount = $feedItem->getLikeCount();

        //How many Comments?
        $commentCount = $feedItem->getCommentCount();

        //Get the Comments
        $comments = $feedItem->getComments();

        //Which Filter did they use?
        $filterType = $feedItem->getFilterType();

        //Grab a list of Images for this Post (different sizes)
        $images = $feedItem->getImageVersions2()->getCandidates();

        //Grab the URL of the first Photo in the list of Images for this Post
        $photoUrl = $images[0]->getUrl();

        //todo: Do something with it :)

        //Output the Photo URL
        echo $photoUrl . "\n";

    }

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}