<?php
include("helpers.php");
require_once('TwitterAPIExchange.php');
header('Content-Type: text/html; charset=utf-8');

/** Set access tokens here - see: https://apps.twitter.com/ **/
$APIsettings = array(
    'oauth_access_token' => "YOUR_ACCESS_TOKEN",
    'oauth_access_token_secret' => "YOUR_ACCESS_TOKEN_SECRET",
    'consumer_key' => "YOUR_CONSUMER_KEY",
    'consumer_secret' => "YOUR_CONSUMER_KEY_SECRET"
);

/** Set Lyrics Wikia Artist Page here **/
$artistWikiaLink = "LYRICS_WIKIA_ARTIST_PAGE"; // For example, for Manchester Orchestra: http://lyrics.wikia.com/Manchester_Orchestra

// Get list of songs with lyrics from artist page
$artistLink = substr(strrchr( $artistWikiaLink, '/' ), 1);
$artistPage = getCURLOutput($artistWikiaLink);
$artistXpath = getDOMXPath($artistPage);
$songs = $artistXpath->query('//b/a[starts-with(@href, "/'.$artistLink.':") and not(contains(@href, "?action=edit"))]');

// Take random song
if($songs->length > 0){
  $idx = intval(rand(0, $songs->length - 1));
  $songAttrHref = $songs->item($idx)->getAttribute("href");
  $songAttrTitle = $songs->item($idx)->getAttribute("title");
  $artistName = substr($songAttrTitle, 0 , strrpos($songAttrTitle, ":"));
  $songName = substr($songAttrTitle, strrpos($songAttrTitle, ":") + 1);
  $lyricsLink = "http://lyrics.wikia.com" . $songAttrHref;

  // Get the lyrics and credits
  $lyricsPage = getCURLOutput($lyricsLink);
  $lyricsXpath = getDOMXPath($lyricsPage);
  $lyricsQuery = $lyricsXpath->query('//div[@class="lyricbox"]/text()');
  $creditsQuery = $lyricsXpath->query('//div[@class="song-credit-box"]/text()');
  for($i = 0; $i < $lyricsQuery->length; $i++){
    $lyrics .= $lyricsQuery->item($i)->nodeValue;
    $lyrics .= "\n";
  }
  $lyrics = delete_all_between("(", ")", $lyrics);

  // Create the tweet between 1 and 4 sentences
  $splitLyrics = explode("\n", $lyrics);
  $sentences = intval(rand(1, 4));
  do{
    $tweet = "";
    $counter = 0;
    $randomIdx = intval(rand(0, count($splitLyrics)));
    while($randomIdx < count($splitLyrics) && strlen($tweet . $splitLyrics[$randomIdx]) < 140 && $counter < $sentences){
      $tweet .= "\n" . $splitLyrics[$randomIdx];
      $randomIdx++;
      $counter++;
    }
  }while(strlen($tweet) < 20 || strlen($tweet) > 140);

  // Post the tweet
  $postfields = array(
      'status' =>  $tweet);
  $url = "https://api.twitter.com/1.1/statuses/update.json";
  $requestMethod = "POST";
  $twitter = new TwitterAPIExchange($APIsettings);
  echo $twitter->buildOauth($url, $requestMethod)
                ->setPostfields($postfields)
                ->performRequest();
}

 ?>
