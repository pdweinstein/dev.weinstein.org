<?php

    // Script to routinely archive tweets in WordPress
    // Twitter API max is 3200 tweets in batches of 200

    include_once( '../lib/model/server/php/twitter-api-php/TwitterAPIExchange.php' );    
    include_once( '../config.php' );

    $twitterURL = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';

    for( $masterCount = 0; $masterCount <= 16 ; $masterCount++ ) {

        if( $masterCount > 0 ) {

            $getfield = '?screen_name=pdweinstein&tweet_mode=extended&count=200&max_id=' .$endWith;

        } else {

            $getfield = '?screen_name=pdweinstein&tweet_mode=extended&count=200';

        }

        $twitter = new TwitterAPIExchange( $twitterSettings );

        $tweets = json_decode( $twitter->setGetfield( $getfield )->buildOauth( $twitterURL, $requestMethod )->performRequest() );

//        var_dump( $tweets );

        for( $counter = 0; $counter <= 200; $counter++ ){

            print( $tweets[$counter]->id. ":" .$tweets[$counter]->created_at. "\n" .$tweets[$counter]->full_text. "\n" );
            print( $tweets[$counter]->entities->media[0]->media_url_https. "\n\n" );

//            var_dump( $tweets[$counter]->entities->media );

            if( $counter == 199 ) {

                $endWith = $tweets[$counter]->id;

            }
        }

    }

?>