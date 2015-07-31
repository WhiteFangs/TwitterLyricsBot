# TwitterLyricsBot
A simple Twitter bot made in PHP that tweets random lyrics from a chosen artist

## Install

- [Create a Twitter app](https://apps.twitter.com/) with your bot's account
- Set access tokens in the `LyricsBot.php` file
- Go to [Lyrics Wikia](http://lyrics.wikia.com/) and find the desired artist's page, copy the URL
- Set `$artistWikiaLink` variable in `LyricsBot.php` to the artist's lyrics wikia page URL you found
- Create a CRON Job that runs `LyricsBot.php` whenever you want your bot to tweet

## Example

[@MancOrchSays](https://twitter.com/MancOrchSays) is a Twitter bot that tweets random lyrics from Manchester Orchestra.

## License
The source code of this bot is available under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).
