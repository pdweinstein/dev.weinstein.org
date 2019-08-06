<?php

	// To Do: Add autoloading
        include_once( '../lib/model/server/php/class.outside.php' );
        include_once( '../lib/model/server/php/b-sig.php' );
        include_once( '../lib/model/server/php/goodReads.php' );
        include_once( '../lib/model/server/php/twitter-api-php/TwitterAPIExchange.php' );
        include_once( '../lib/model/server/php/phpFlickr.php' );
	include_once( '../lib/view/server/php/class.template.php' );

        if ( $location != 'local' ) {
                $memcache = new Memcache;
        }

        //$seti = new RPC;

        $goodReads = new goodReads( $goodreads_token, $goodreads_user_id, $goodreadsOptions, true);

        $twitter = new TwitterAPIExchange( $twitterSettings );

        $flickr = new phpFlickr( FLICKR_API );

        $elsewhere = new Outside;

?>
