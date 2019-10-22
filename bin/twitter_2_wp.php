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
/*
                if (( $masterCount > 0 ) && $counter == 0 ) {

                    // Skip repeat of last/first
                    $counter++;

                }
*/
                // Same process as with cache!
                processTweet( $tweets[$counter] );
                array_push( $posts, $post );

                if( $counter <= 99 ) {

                    $endWith = $tweets[$counter]->id;

                }

            }

        }

        validate( $posts );

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
        for( $counter = 0; $counter <= sizeof( $posts ); $counter ++ ) {

            // If multiple tweets on same day, include in one WP post
            // with multiple links to orginal tweet on Twitter
            while( date( "Y-m-d", strtotime( $posts[$counter]['date'] )) == date( "Y-m-d", strtotime( $posts[$counter+1]['date'] ))) {

                print( $posts[$counter]['post'] ); 
                print( $posts[$counter+1]['post'] ); 
                $counter = $counter + 1;
                $multi = true;

            }

            if( !$multi ) {

                print( $posts[$counter]['post'] ); 

            }

            $multi = false;

            print( 'Type "y" to continue: ' );
            $handle = fopen ( 'php://stdin', 'r' );
            $line = fgets( $handle );
            if( trim( $line ) != 'y' ) {

                exit;

            }

            fclose( $handle );

            if( !empty($posts[$counter+1])) {

                if ( $post['id'] == $posts[$counter+1]['id'] ) {

                    # Duplicates, skip next tweet
                    $counter++;

                }

            }

        }

    }

    function processTweet( $tweetObj ) {

        // Include other entities, such as link title/desc from URL Object?
        // If reply/conversation? in_reply_to_status
        // TO DO: Print Geo info, coordinates
//        var_dump( $tweetObj );

        // Better format for date than Twitters
        // Post title: mon dd yy - like old posts
        $tDate = $tweetObj->created_at;
        $localTimeStamp = date( "Y-m-d h:i:s", strtotime( $tDate ));
        $wpPostDate = date( "M d y", strtotime( $tDate ));
        $humanDate = date( "d F Y", strtotime( $tDate ));

        $tweet = preg_replace( '/((http|https):\/\/[^\s]+)/', '<a href="$0">$0</a>', $tweetObj->full_text );
        $post = "<p align='right'>First published: <a href='https://twitter.com/pdweinstein/status/" .$tweetObj->id. "' rel='canonical'>" .$humanDate. "</a> on <a href='https://www.twitter.com/pdweinstein/'>Twitter</a></p>";
        $post .= "<p>" .preg_replace( '/@([^\s]+)/', '<a href="http://twitter.com/$1">$0</a>', $tweet ). "</p>\n";

        // If retweet, include orginal message in full
        if( !empty( $tweetObj->retweeted_status )) {
        
            $retweet = preg_replace( '/((http|https):\/\/[^\s]+)/', '<a href="$0">$0</a>', $tweetObj->retweeted_status->full_text );
            $post .= "<p>Original Tweet: " .$retweet. "</p>\n";

        }

        if( !empty( $tweetObj->entities->media )) {

            // Can have more than one media element!
            foreach( $tweetObj->entities->media as $media ) {

                $post .= "<p><img src=\"" .$media->media_url_https. "\" alt=\"\"></p>\n\n";

            }

        } else {

            $post .="\n";

        }

        $posts = array( date => $localTimeStamp, id => $tweetObj->id, post => $post );
        return $posts;

    }


?>