<?php

	include_once( '../config.php' );
	include_once( 'include.php' );

        if (( $location = 'local' ) OR 
        	( !$posts = $memcache->get( 'latest_pdw' ))) {

		// Get our latest results
       		$books = $goodReads->getShelf();
		$githubEvents = $elsewhere->getGitHubEvents();
		$recent = $flickr->people_getPublicPhotos( FLICKR_USER );
		$info = $flickr->photos_getInfo( $recent['photos']['photo'][0]['id'] );
		$instaObj = $elsewhere->getInstaPosts( $instaToken, 1 );
		$tweets = json_decode( $twitter->setGetfield( $getfield )->buildOauth( $twitterURL, $requestMethod )->performRequest() );

		// GitHub Last Post	
		$GHrecent = $githubEvents[0];
		$posts['github'] = strtotime( $GHrecent->created_at );

		// Flickr Last Post	
		$posts['flickr'] = $info['photo']['dateuploaded'];
		// Goodreads. No date for post (start/end reading dates)

		// Instagram Last Post	
		$instaData = $instaObj->{'data'};
		$posts['instagram'] = $instaData[0]->{'created_time'};

		// Twitter Last Post
		$tweet = $tweets[0];
		$posts['twitter'] = strtotime( $tweet->created_at );

		// Sort Array of Unix Timestamps
		arsort( $posts );

		// Reset our pointer to the top of the array
		reset( $posts );

		// Pull our winner
		//var_dump( $posts );
		$latest = key( $posts );

		if( $location != 'local' ) {

			$memcache->set( 'latest_pdw', $latest, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'hub_pdw', $githubEvents, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'flickr_pdw', $recent, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'reads_pdw', $books, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'insta_pdw', $instaData, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'tweets_pdw', $tweets, MEMCACHE_COMPRESSED, 3600 );
			
		}

        } else {

		if( $location != 'local' ) {

			$posts = $memcache->get( 'latest_pdw' );
			$githubEvents = $memcache->get( 'hub_pdw' );
			$recent = $memcache->get( 'flickr_pdw' );
			$books = $memcache->get( 'reads_pdw' );
			$instaData = $memcache->get( 'insta_pdw' );
			$tweets = $memcache->get( 'tweets_pdw' );

		}


	}

?>
