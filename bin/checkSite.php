#!/usr/local/bin/php

<?php

  // Script to get a URL/IP and check HTTP Status

  // Config Run Enviroment
  error_reporting( 0 );

  // Get args from command-line
  if ( $argc > 3 ) {

    echo "Host name and email address arguments are required, -h -e\n\n";
    exit();

  } else {

    $url = $argv[1];
    $email = $argv[2];

  }

  // Should also be validading email arg!
  if ( !$url || !is_string($url) || ! preg_match('/^http(s)?:\/\/[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url )) {

    echo "Hostname is invalid\n\n";
    exit();

  } else {

    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_HEADER, true );    // we want headers
    curl_setopt( $ch, CURLOPT_NOBODY, true );    // we don't need body
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );

    $output = curl_exec( $ch );
    $httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close( $ch );
echo "Here is: " . $httpcode . "\n\n";
    if (( $rhttpcodei == 0 ) OR ( httpcode >= 400 )) {
echo "sending\n\n";
      mail( $email, "", "Site notification for " .$url. " Status code: " .httpcode, "From: <no-reply@weinstein.org>\r\n");

    }
  }

?>
