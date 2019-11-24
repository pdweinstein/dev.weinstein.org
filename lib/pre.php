<?php

	include_once( '../config.php' );
	include_once( 'include.php' );

        use Facebook\Facebook;
        use Facebook\Exceptions\FacebookResponseException;
        use Facebook\Exceptions\FacebookSDKException;

        if ( $location != 'local' ) {

                $memcache = new Memcache;
		$memcache->addServer( $mhost, $mport );

        	if ( $posts = $memcache->get( 'latest' )) {

			$posts = $memcache->get( 'latest' );
			$githubEvents = $memcache->get( 'github' );
			$recent = $memcache->get( 'flickr_recent' );
			$info = $memcache->get( 'flickr_info' );
			$books = $memcache->get( 'goodreads' );
			$instaData = $memcache->get( 'instagram' );
			$tweets = $memcache->get( 'tweets' );

		}

	}

        if (( $location == 'local' ) OR 
        	( !$posts = $memcache->get( 'latest' ))) {

		//$seti = new RPC;

        	$goodReads = new goodReads( $goodreads_token, $goodreads_user_id, $goodreadsOptions, true);

        	$twitter = new TwitterAPIExchange( $twitterSettings );

        	$flickr = new phpFlickr( FLICKR_API );

        	$elsewhere = new Outside;

		$fb = new Facebook([
			'app_id' => $appId,
			'app_secret' => $appSecret,
			'default_graph_version' => 'v3.1'
		]);

		// Get our latest results
       		$books = $goodReads->getShelf();
		$githubEvents = $elsewhere->getGitHubEvents();
		$recent = $flickr->people_getPublicPhotos( FLICKR_USER );
		$info = $flickr->photos_getInfo( $recent['photos']['photo'][0]['id'] );
		$instaObj = $elsewhere->getInstaPosts( $instaToken, 1 );
		$tweets = json_decode( $twitter->setGetfield( $getfield )->buildOauth( $twitterURL, $requestMethod )->performRequest() );

		if( $location != 'local' ) {

			$memcache->set( 'latest', $latest, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'github', $githubEvents, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'flickr_recent', $recent, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'flickr_info', $info, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'goodreads', $books, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'instagram', $instaObj, MEMCACHE_COMPRESSED, 3600 );
			$memcache->set( 'twitter', $tweets, MEMCACHE_COMPRESSED, 3600 );
			
		}

	}

	// GitHub Last Post	
	$GHrecent = $githubEvents[0];
	$posts['github'] = strtotime( $GHrecent->created_at );
	$feed['github'] = $GHrecent;

	// Flickr Last Post	
	$posts['flickr'] = $info['photo']['dateuploaded'];
	$feed['flickr'] = $info;

	// Goodreads. No date for post (start/end reading dates)

	// Instagram Last Post	
	$instaData = $instaObj->{'data'};
	$posts['instagram'] = $instaData[0]->{'created_time'};
	$feed['instagram'] = $instaData;

	// Twitter Last Post
	$tweet = $tweets[0];
	$posts['twitter'] = strtotime( $tweet->created_at );
	$feed['twitter'] = $tweets;

	// Sort Array of Unix Timestamps
	arsort( $posts );

	// Reset our pointer to the top of the array
	reset( $posts );

	// Pull our winner
	$latest = key( $posts );
	$latestDate = gmdate( "M d Y", $posts[$latest] );

?>
