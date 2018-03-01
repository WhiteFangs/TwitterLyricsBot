# TwitterLyricsBot
A simple Twitter bot made in PHP that tweets random lyrics from a chosen artist

## Install

- [Create a Twitter app](https://apps.twitter.com/) with your bot's account
- Set access tokens in a  `twitterCredentials.php` file in the root folder
- Go to [Lyrics Wikia](http://lyrics.wikia.com/) and find the desired artist's page, copy the URL
- Set `$artistWikiaLink` variable in `LyricsBot.php` to the artist's lyrics wikia page URL you found
- Create a CRON Job that runs `LyricsBot.php` whenever you want your bot to tweet

## How it works

The program goes to the Wikia page of the chosen artist and picks a random song, then takes an excerpt from the song's lyrics and tweets it. 

## Example

[@MancOrchSays](https://twitter.com/MancOrchSays) and [@BiffySays](https://twitter.com/BiffySays) are Twitter bots that tweets random lyrics from Manchester Orchestra and Biffy Clyro.

## License
The source code of this bot is available under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).
