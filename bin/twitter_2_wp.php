<?php

    // Script to routinely archive tweets in WordPress
    // Twitter API max is 3200 tweets in max batches of 200

    // Two modes, fetch data from Twitter or read from local JSON 
    // In either mode, step thru one by one and query user to create WP entry or skip?

    include_once( '../lib/model/server/php/twitter-api-php/TwitterAPIExchange.php' );    
    include_once( '../config.php' );

    $twitterURL = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';

    $file = 'twitter.json';

    $options = getopt( 'm:' );
    $mode = $options['m'];

    $posts = array();

    if( $mode != 'cache' ) {

        for( $masterCount = 0; $masterCount < 32 ; $masterCount++ ) {

            if( !empty( $endWith ) ) {

              $getfield = '?screen_name=pdweinstein&tweet_mode=extended&count=100&max_id=' .$endWith;

            } else {

                $getfield = '?screen_name=pdweinstein&tweet_mode=extended&count=100';

            }

            $twitter = new TwitterAPIExchange( $twitterSettings );
            $response = $twitter->setGetfield( $getfield )->buildOauth( $twitterURL, $requestMethod )->performRequest();

            // Save response to local file for future/offline processing
            $contents = file_get_contents( $file );
            $contents .= $response. "\n";
            file_put_contents( $file, $contents );

            $tweets = json_decode( $response );

    //        var_dump( $tweets );

            for( $counter = 0; $counter < 100; $counter++ ){

                $totalCount = ( $counter + 1 ) + ( $masterCount * 100 );

                if (( $masterCount > 0 ) && $counter == 0 ) {

                    // Skip repeat of last/first
                    $counter++;

                }

                // TO DO: Update to refect same process as with cache!
                processTweet( $tweets[$counter] );

                if( $counter <= 99 ) {

                    $endWith = $tweets[$counter]->id;

                }
            }

        }

    } else {

        $fh = fopen( $file, 'r' );

        while( !feof( $fh )) {

            $line = fgets( $fh );
            $tweets = json_decode( $line );

            foreach( $tweets as $tweet ){

                $post = processTweet( $tweet );
                array_push( $posts, $post );

            }

        }

        validate( $posts );

    }
    
    function validate( $posts ) {

        // TO DO: Review and commit to creating WP post or skip
        // Post title: mon dd yy - like old posts
        // TO DO: Compare current & previous ids, is this a duplicate?

        for( $counter = 0; $counter <= sizeof( $posts ); $counter ++ ) {

            $post = $posts[$counter];
            $key = key( $post );
            print( $post[$key] ); 
            print( 'Type "y" to continue: ' );
            $handle = fopen ( 'php://stdin', 'r' );
            $line = fgets( $handle );
            if( trim( $line ) != 'y' ) {

                exit;

            }

            fclose( $handle );

            if( !empty($posts[$counter + 1])) {

                if ( !array_diff_key( $posts[$counter], $posts[$counter+1] )) {

                    # Duplicates, skip next tweet
                    $counter++;

                }

            }

        }

    }

    function processTweet( $tweetObj ) {

        // If multiple tweets on same day, include in one WP post? 
        // With multiple links to orginal tweet on Twitter?
        // Include other entities, such as link headline/previews?
        // If retweet, include orginal message in full
        // If reply/conversation?
        // TO DO: Print Geo info, if tagged
        // Better format for date than Twitters
        $tweet = preg_replace( '/((http|https):\/\/[^\s]+)/', '<a href="$0">$0</a>', $tweetObj->full_text );
        $post = "<p align='right'>First published: <a href='https://twitter.com/pdweinstein/status/" .$tweetObj->id. "' rel='canonical'>" .$tweetObj->created_at. "</a> on <a href='https://www.twitter.com/pdweinstein/'>Twitter</a></p>";
        $post .= "<p>" .preg_replace( '/@([^\s]+)/', '<a href="http://twitter.com/$1">$0</a>', $tweet ). "</p>\n";

        if( !empty( $tweetObj->entities->media )) {

            // Can have more than one media element!
            foreach( $tweetObj->entities->media as $media ) {

                $post .= "<p><img src=\"" .$media->media_url_https. "\" alt=\"\"></p>\n\n";

            }

        } else {

            $post .="\n";

        }

        $posts[$tweetObj->id] = $post;
        return $posts;

    }


?>