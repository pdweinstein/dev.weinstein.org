<?php

	use Facebook\Facebook;
	use Facebook\Exceptions\FacebookResponseException;
	use Facebook\Exceptions\FacebookSDKException;

	// To Do: Add autoloading
        include_once( '../lib/model/server/php/class.outside.php' );
        include_once( '../lib/model/server/php/b-sig.php' );
        include_once( '../lib/model/server/php/goodReads.php' );
        include_once( '../lib/model/server/php/twitter-api-php/TwitterAPIExchange.php' );
        include_once( '../lib/model/server/php/phpFlickr.php' );
	include_once( '../lib/view/server/php/class.template.php' );
	include_once( '../lib/model/server/php/php-graph-sdk-5.x/src/Facebook/autoload.php' );
	include_once( '../lib/model/server/php/php-graph-sdk-5.x/src/Facebook/Exceptions/FacebookResponseException.php' );
	include_once( '../lib/model/server/php/php-graph-sdk-5.x/src/Facebook/Exceptions/FacebookSDKException.php' );
	include_once( '../lib/model/server/php/php-graph-sdk-5.x/src/Facebook/Helpers/FacebookRedirectLoginHelper.php' );

        if ( $location != 'local' ) {
                $memcache = new Memcache;
        }

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

?>
