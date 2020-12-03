<?php

    include_once('../../lib/model/server/php/InstagramBasicDisplay.php');
    include_once('../../lib/model/server/php/InstagramBasicDisplayException.php');
    use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;

    $instagram = new InstagramBasicDisplay([
        'appId' => '1018746275285857',
        'appSecret' => 'cbb3a371f3d21360fc328df8b18815b4',
        'redirectUri' => 'https://www.weinstein.org/ig/'
    ]);

    $code = $_GET['code'];
    $location = 'remote';
    $mhost = '127.0.0.1';
    $mport = '11211';

    if ( $location != 'local' ) {
    
        $memcache = new Memcache;
        $memcache->addServer( $mhost, $mport );
		    
        if ( $token = $memcache->get( 'igToken' )) {

            $instagram->setAccessToken( $token );
            #echo "From cache: " .$token;

	}

    }
    
    if (( !empty( $token )) OR
         ( !empty( $code ))) {

            // Get the short lived access token (valid for 1 hour)
            $token = $instagram->getOAuthToken($code, true);

            // Exchange this token for a long lived token (valid for 60 days)
            $token = $instagram->getLongLivedToken($token, true);

            if( $location != 'local' ) {

                $memcache = new Memcache;
                $memcache->addServer( $mhost, $mport );

#                $token = $instagram->getAccessToken();
#	        $token = $instagram->refreshToken( $token, true );

		$memcache->set( 'igToken', $token, MEMCACHE_COMPRESSED, 2592000 );

	    }

        $instagram->setAccessToken($token);

        $profile = $instagram->getUserProfile();

	var_dump( $instagram->getUserMedia());

    } else {

        echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";

    }

?>
