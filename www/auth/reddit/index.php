<?php

    include_once( '../../../config.php' );

    // vars to get access token
    $url ='https://ssl.reddit.com/api/v1/access_token';

    $fields = array (
        'grant_type' => 'client_credentials',
        'duration' => 'permanent'
    );

    $userAgent = 'www.weinstein.org Reddit Bot - v1';

    $field_string = http_build_query( $fields );

    $curl = curl_init( $url );
    curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'Authorization: Basic ' . base64_encode( $redditID . ':' . $redditSecret )));
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curl, CURLOPT_USERAGENT, $userAgent );
    curl_setopt( $curl, CURLOPT_POST, 1 );
    curl_setopt( $curl, CURLOPT_POSTFIELDS, $field_string );

    $response = curl_exec( $curl );
    $err = curl_error( $curl );
    curl_close( $curl );

    $response = json_decode( $response, true );
    //var_dump( $response ); // access_token should be here

    $curl = curl_init( 'https://oauth.reddit.com/user/pdweinstein/submitted' );
    curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $response['access_token'] ));
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curl, CURLOPT_USERAGENT, $userAgent );

    $response = curl_exec( $curl );
    $err = curl_error( $curl );
    curl_close( $curl );

    $response = json_decode( $response, true );
    //var_dump( $response ); // data should be here
    var_dump( $response['data']['children'][0] );

?>
