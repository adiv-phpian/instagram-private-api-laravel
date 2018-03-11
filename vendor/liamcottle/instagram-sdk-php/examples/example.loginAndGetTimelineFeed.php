<?php

require("../vendor/autoload.php");

$instagram = new \Instagram\Instagram();

try {

    //Login
    $instagram->login("username", "password");

    //Get TimelineFeed
    $timelineFeed = $instagram->getTimelineFeed();

    foreach($timelineFeed->getItems() as $timelineFeedItem){

        //User Object, (who posted this)
        $user = $timelineFeedItem->getUser();

        //Caption Object
        $caption = $timelineFeedItem->getCaption();

        //How many Likes?
        $likeCount = $timelineFeedItem->getLikeCount();

        //How many Comments?
        $commentCount = $timelineFeedItem->getCommentCount();

        //Get the Comments
        $comments = $timelineFeedItem->getComments();

        //Which Filter did they use?
        $filterType = $timelineFeedItem->getFilterType();

        //Grab a list of Images for this Post (different sizes)
        $images = $timelineFeedItem->getImageVersions2()->getCandidates();

        //Grab the URL of the first Photo in the list of Images for this Post
        $photoUrl = $images[0]->getUrl();

        echo sprintf("---------- Timeline Item ----------\n");
        echo sprintf("User: %s [%s]\n", $user->getFullName(), $user->getUsername());
        echo sprintf("Caption: %s\n", $caption->getText());
        echo sprintf("Like Count: %s\n", $likeCount);
        echo sprintf("Comment Count: %s\n", $commentCount);
        echo sprintf("Filter Type: %s\n", $filterType);
        echo sprintf("Comments:\n", $commentCount);

        foreach($comments as $comment){

            $commentUser = $comment->getUser();

            echo sprintf("---------- Comment ----------\n");
            echo sprintf("User: %s [%s]\n", $commentUser->getFullName(), $commentUser->getUsername());
            echo sprintf("Text: %s\n", $comment->getText());
            echo sprintf("--------- \\Comment ----------\n");

        }

    }

} catch(Exception $e){
    //Something went wrong...
    echo $e->getMessage() . "\n";
}