#!/usr/local/bin/php

<?php

  // Script to get a URL/IP and check HTTP Status
  // Usage: ./checkSite.php https://www.example.org webmaster@example.org

  // Config Run Enviroment
  error_reporting( 1 );
  include_once( '../config.php' );
  include_once( '../lib/PHPMailer.php' );
  include_once( '../lib/SMTP.php' );

  use PHPMailer\PHPMailer\PHPMailer;
  $mail = new PHPMailer( true );

  // SMTP settings
  // SMTP Debug:
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0; 
  $mail->isSMTP();
  $mail->Host = $SMTPHost;
  $mail->SMTPAuth = true;
  $mail->Username = $SMTPUser;
  $mail->Password = $SMTPPass;
  $mail->SMTPSecure = 'tls';
  $mail->Port = $SMTPPort;

  // Get args from command-line
  if ( $argc > 3 ) {

    echo "Host name and email address arguments are required, -h -e\n\n";
    exit();

  } else {

    $url = $argv[1];
    $email = $argv[2];

    //echo "Here is: " .$url. "\n";
    //echo "Here is: " .$email. "\n";

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

    //echo "Host " .$url. " response is: " .$httpcode. "\n";

    if (( $httpcode == 0 ) OR ( $httpcode >= 400 )) {

      // Recipient
      $mail->setFrom( 'auto@weinstein.org', 'Mailer' );
      $mail->addAddress( $email, '' );
      $mail->addReplyTo( 'do-no-reply@weinstein.org', 'No Reply');

      // Content
      $mail->Subject = 'Site Alert';
      $mail->Body    = 'Site ' .$url. ' is returning status code: ' .$httpcode;
      $mail->send();

    }
  }

?>
