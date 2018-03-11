## Instagram-SDK-PHP

[![Latest Stable Version](https://poser.pugx.org/liamcottle/instagram-sdk-php/version)](https://packagist.org/packages/liamcottle/instagram-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/liamcottle/instagram-sdk-php/v/unstable)](//packagist.org/packages/liamcottle/instagram-sdk-php)
[![Total Downloads](https://poser.pugx.org/liamcottle/instagram-sdk-php/downloads)](https://packagist.org/packages/liamcottle/instagram-sdk-php)
[![Daily Downloads](https://poser.pugx.org/liamcottle/instagram-sdk-php/d/daily)](https://packagist.org/packages/liamcottle/instagram-sdk-php)

This is an unofficial SDK for the Instagram Private API in PHP

## Motivation

I decided to build this because most libraries for the Instagram Private API I have come across aren't OOP based and are difficult to use.

## Donations

If you like this project, please consider donating towards my coffee addiction fund, so I can continue to push commits!

- ![Paypal](https://raw.githubusercontent.com/reek/anti-adblock-killer/gh-pages/images/paypal.png) Paypal: [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JMMKQZYBM2SA8)
- ![btc](https://camo.githubusercontent.com/4bc31b03fc4026aa2f14e09c25c09b81e06d5e71/687474703a2f2f7777772e6d6f6e747265616c626974636f696e2e636f6d2f696d672f66617669636f6e2e69636f) Bitcoin: 1814x9kioBxPDBCQx8oaty7e6Z3DAosucd


## Installation

### Composer

```sh
composer require liamcottle/instagram-sdk-php
```
```php
require("../vendor/autoload.php");
$instagram = new \Instagram\Instagram();
```

If you want to test code that is in the master branch, which hasn't been pushed as a release, you can use `dev-master`.

```sh
composer require liamcottle/instagram-sdk-php dev-master
```

### Don't have Composer?

What?! Grab it here: [https://getcomposer.org/](https://getcomposer.org/)

## Examples

Examples can be seen in the [examples](./examples) folder.

## Usage

### Login

Read: [Session Management](#session-management), to avoid calling `login` in each script.

```php
$instagram->login("username", "password");
```

### Timeline Feed

- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getTimelineFeed($maxId);
```

### User Feed

- `$userId`:`string|User` User or User Id to get Feed of
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getUserFeed($userId, $maxId);
```

### My User Feed

- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getMyUserFeed($maxId);
```

### Liked Feed

- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getLikedFeed($maxId);
```

### Tag Feed

- `$tag`:`string` Tag
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getTagFeed($tag, $maxId);
```

### Location Feed

- `$locationId`:`string|Location` Location or Location Id to get Feed of
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getLocationFeed($locationId, $maxId);
```

### User Tags Feed

- `$userId`:`string|User` User of User Id to get Tags Feed of
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getUserTagsFeed($userId, $maxId);
```

### Like Media

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to Like

```php
$instagram->likeMedia($mediaId);
```

### Unlike Media

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to Unlike

```php
$instagram->unlikeMedia($mediaId);
```

### Delete Media

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to Delete
- `$mediaType`:`int` Media Type (Constants available in `DeleteMediaRequest` class)

```php
$instagram->deleteMedia($mediaId, $mediaType);
```

### Comment on Media

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to Comment on
- `$comment`:`string` Comment

```php
$instagram->commentOnMedia($mediaId, $comment);
```

### Get Media Comments

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id of Media to get Comments from
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getMediaComments($mediaId, $maxId);
```

### Delete Media Comments

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to Delete Comments from
- `$commentIds`:`array` Comment Ids to Delete

```php
$instagram->deleteCommentsFromMedia($mediaId, $commentIds);
```

### User Info

- `$userId`:`string|User` User or User Id to get Info of

```php
$instagram->getUserInfo($userId);
```

### User Followers

- `$userId`:`string|User` User or User Id to get Followers of
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getUserFollowers($userId, $maxId);
```

### User Following

- `$userId`:`string|User` User or User Id to get Following of
- `$maxId`:`string` (Optional) Used for Pagination

```php
$instagram->getUserFollowing($userId, $maxId);
```

### GeoMedia

- `$userId`:`string|User` User or User Id to get GeoMedia of

```php
$instagram->getUserMap($userId);
```

### Media Info

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to get Info of

```php
$instagram->getMediaInfo($mediaId);
```

### Current User Account

```php
$instagram->getCurrentUserAccount();
```

### Edit User Profile

- `$firstname`:`string` First Name
- `$email`:`string` Email
- `$phoneNumber`:`string` Phone Number
- `$gender`:`int` Gender (Constants available in `User` class)
- `$biography`:`string`: Biography
- `$externalUrl`:`string` External Url

```php
$instagram->editUserProfile($firstname, $email, $phoneNumber, $gender, $biography, $externalUrl);
```

### Set Account Public

```php
$instagram->setAccountPublic();
```

### Set Account Private

```php
$instagram->setAccountPrivate();
```

### Show Friendship

- `$userId`:`string|User` User or User Id to show Friendship between

```php
$instagram->showFriendship($userId);
```

### Follow User

- `$userId`:`string|User` User or User Id to Follow

```php
$instagram->followUser($userId);
```

### Unfollow User

- `$userId`:`string|User` User or User Id to Unfollow

```php
$instagram->unfollowUser($userId);
```

### Block User

- `$userId`:`string|User` User or User Id to Block

```php
$instagram->blockUser($userId);
```

### Unblock User

- `$userId`:`string|User` User or User Id to Unblock

```php
$instagram->unblockUser($userId);
```

### Search Tags

- `$query`:`string` Tag to Search for

```php
$instagram->searchTags($query);
```

### Search Users

- `$query`:`string` User to Search for

```php
$instagram->searchUsers($query);
```

### Search Places (Facebook)

- `$query`:`string` Place to Search for

```php
$instagram->searchFacebookPlaces($query);
```

- `$latitude`:`string` Latitude
- `$longitude`:`string` Longitude

```php
$instagram->searchFacebookPlacesByLocation($latitude, $longitude);
```

### Change Profile Picture

- `$path`:`string` File path of Profile Picture to Upload

```php
$instagram->changeProfilePicture($path);
```

### Remove Profile Picture

```php
$instagram->removeProfilePicture();
```

### Post Photo

- `$path`:`string` File path of Photo to Post
- `$caption`:`string` Caption for this Photo

```php
$instagram->postPhoto($path, $caption);
```

### Edit Media

- `$mediaId`:`string|FeedItem` FeedItem or FeedItem Id to Edit
- `$caption`:`string` Caption for this Media

```php
$instagram->editMedia($mediaId, $caption);
```

### Get User by Username

- `$username`:`string` Username to find User by

```php
$instagram->getUserByUsername($username);
```

### Logout

```php
$instagram->logout();
```

## Session Management

To avoid logging in each time, you can use the `saveSession` and `initFromSavedSession` methods.

Script 1:

```php
//Login
$instagram->login("username", "password");

//Serialize the Session into a JSON string
$savedSession = $instagram->saveSession();

//Store $savedSession in Database, or Cookie etc
```

Script 2:

```php
//Load $savedSession from Database or Cookie etc
$savedSession = ...;

//Init from Saved Session
$instagram->initFromSavedSession($savedSession);

//Session is Restored, do something!
$instagram-> ...;
```

## Extras

### Pagination

Some Instagram endpoints return paginated data.

To access the next page of data, you will need to get the next maximum ID from the response object and pass it into the same method as the `nextMaxId` parameter.

**Example:**

```php
//Get TimelineFeed
$timelineFeed = $instagram->getTimelineFeed();

//This will be null if there are no more pages.
$nextMaxId = $timelineFeed->getNextMaxId();

//We have another page of Items
if($nextMaxId != null){
	//Get the next page.
	$timelineFeed = $instagram->getTimelineFeed($nextMaxId);
}
```

### Proxy

Use a Proxy between your Server and the Instagram API

```php
$instagram->setProxy("127.0.0.1:8888");
```

Optional Username/Password Authentication

```php
$instagram->setProxy("127.0.0.1:8888", "proxyUsername", "proxyPassword");
```

Enable or Disable Peer Verification, for testing with Charles Proxy etc.

```php
$instagram->setVerifyPeer(false);
```

## TODO

- Inbox
- Direct Share
- Recent Activity
- Register new Accounts
- Upload and Post Videos

## Contributing

If you would like to contribute to this project, please feel free to submit a pull request.

Before you do, take a look at the issues to see if the functionality you want to contribute to is already in development.

## License

MIT

## Legal

The name "Instagram" is a copyright of Instagram, Inc.

This project is in no way affiliated with, authorized, maintained, sponsored or endorsed by Instagram, Inc or any of its affiliates or subsidiaries.

I, the project owner and creator, am not responsible for any legalities that may arise in the use of this project. Use at your own risk.