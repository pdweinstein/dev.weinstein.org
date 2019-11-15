<?php

/*
 *   @package		template-php
 *   @author		Paul Weinstein, <pdw@weinstein.org>
 *   @version		0.1
 *	@copyright	Copyright (c) 2018 Paul Weinstein, <pdw@weinstein.org>
 *	@license		MIT License, <https://github.com/pdweinstein/PHP-Wrapper-for-CTA-APIs/blob/master/LICENSE>
 *
 *	Copyright (c) 20118Paul Weinstein, <pdw@weinstein.org>
 *
 *	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files 
 *	(the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, 
 *	publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do
 *	so, subject to the following conditions:
 *
 *	The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *	MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
 *	FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION 
 *	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
 *
 */

// Class is in session
class template {

	// Setup class vars
	var $debug = false;
	var $meta = array( 
		0 => array( "http-equiv" => "Content-Type", "content" => "text/html; charset=utf-8" ),
		1 => array( "name" => "description", "content" => "Pontifications on the Life Universe and Everything; News and commentary about the web, computers, politics, programming, webzines, travel, reading et. al." ),
		2 => array( "name" => "copyright", "content" => "Paul Weinstein" ),
		3 => array( "name" => "author", "content" => "Paul Weinstein" ),
		4 => array( "name" => "robots", "content" => "INDEX,FOLLOW" ),
		5 => array( "property" => "og:type", "content" => "profile" ),
		6 => array( "property" => "og:title", "content" => "www.weinstein.org" ),
		7 => array( "property" => "og:url", "content" => "https://www.weinstein.org/" ),
		8 => array( "property" => "og:image", "content" => "https://storage.googleapis.com/personal-dev-site.appspot.com/view/client/png/thumbnail.png" ),
		9 => array( "property" => "profile:first_name", "content" => "Paul" ),
		10 => array( "property" => "profile:last_name", "content" => "Weinstein" )
	); 
	var $js = array( 
		0 => array( "type" => "text/javascript", "src" => "https://storage.googleapis.com/personal-dev-site.appspot.com/controller/client/js/jquery-3.3.1.min.js" ),
		1 => array( "type" => "text/javascript", "src" => "https://storage.googleapis.com/personal-dev-site.appspot.com/controller/client/js/bootstrap.min.js" ),
		2 => array( "type" => "text/javascript", "src" => "https://storage.googleapis.com/personal-dev-site.appspot.com/controller/client/js/jquery-ui.min.js" ),
		3 => array( "type" => "text/javascript", "src" => "https://www.googletagmanager.com/gtag/js" )
        );

	var $link = array(
		0 => array( "rel" => "stylesheet", "type" => "text/css", "href" => "https://storage.googleapis.com/personal-dev-site.appspot.com/view/client/css/bootstrap.css", "media" => "screen" ),
		1 => array( "rel" => "stylesheet", "type" => "text/css", "href" => "https://storage.googleapis.com/personal-dev-site.appspot.com/view/client/css/screen.css", "media" => "screen" ),
		2 => array( "rel" => "stylesheet", "type" => "text/css", "href" => "https://storage.googleapis.com/personal-dev-site.appspot.com/view/client/css/jquery-ui.css", "media" => "screen" ),
		3 => array( "rel" => "alternate", "type" => "application/atom+xml", "href" => "http://feeds.feedburner.com/pdweinstein?format=xml" ),
		4 => array( "rel" => "shortcut icon", "type" => "image/x-icon", "href" => "https://storage.googlapise.com/personal-dev-site.appspot.com/view/client/ico/favicon.ico" ),
		5 => array( "rel" => "icon", "type" => "image/x-icon", "href" => "https://storage.googleapis.com/personal-dev-site.appspot.com/view/client/ico/favicon.ico" )
	);
	
	/**
	 *	__construct function, let's get this object created.
	 * 
	 *	@access	public
	 */
	public function __construct( $debug = false ) {
	
		$this->debug = $debug;	
	
	}

	public function outputHTML( $string ) {

		echo $string;

	}


	public function outputString( $string ) {
	
		echo htmlentities( $string, ENT_QUOTES, 'UTF-8'); 
	
	}

	public function outputmeta( $meta ) {
	
		$count = sizeof( $meta );
	
		for( $counter = 0; $counter < $count; $counter++ ){
		
			echo "\t\t<meta ";
			
			foreach( $meta[$counter] as $key => $value ) {
			
				echo htmlentities( $key, ENT_QUOTES, 'UTF-8'). '="' .htmlentities( $value, ENT_QUOTES, 'UTF-8'). '" ';
			}
			
			echo "/>\n";		
		
		}	
	
	}

	public function outputJS( $js ) {
	
		$count = sizeof( $js );
	
		for( $counter = 0; $counter < $count; $counter++ ){
		
			echo "\t\t<script ";
			
			foreach( $js[$counter] as $key => $value ) {
			
				echo htmlentities( $key, ENT_QUOTES, 'UTF-8'). '="' .htmlentities( $value, ENT_QUOTES, 'UTF-8'). '" ';
			}
			
			echo "></script>\n";		
		
		}	
	
	}	
	
	public function outputlink( $link ) {
	
		$count = sizeof( $link );
	
		for( $counter = 0; $counter < $count; $counter++ ){
		
			echo "\t\t<link ";
			
			foreach( $link[$counter] as $key => $value ) {
			
				echo htmlentities( $key, ENT_QUOTES, 'UTF-8'). '="' .htmlentities( $value, ENT_QUOTES, 'UTF-8'). '" ';
			}
			
			echo "/>\n";		
		
		}	
	
	}

	public function outputFlickr( $feed ) {

		$this->outputHTML( "<p><img src=\"https://live.staticflickr.com/" .$feed['photo']['server']. "/" .$feed['photo']['id']. "_" .$feed['photo']['secret']. "_c.jpg\" alt=\"" .$feed['photo']['title']['_content']. "\"></p>" );
		$this->outputHTML( "<p>" .$feed['photo']['title']['_content'] );

		if( !empty( $feed['photo']['description']['_content'] )) {

			$this->outputHTML( " - " .$feed['photo']['description']['_content']. "</p>" );

		} else {

			$this->outputHTML( "</p>" );

		}
	}

	public function outputTweet( $feed, $type  ) {

		$tweet = preg_replace( '/((http|https):\/\/[^\s]+)/', '<a href="$0">$0</a>', $feed[0]->full_text );
		$this->outputHTMl( "<p>" .preg_replace( '/@([^\s]+)/', '<a href="http://twitter.com/$1">$0</a>', $tweet ). "</p>" );

        // To Do: Tweets can have more than 1 media item!
		if(( !empty( $feed[0]->entities->media[0]->media_url_https )) AND ( $type == 'main' )) {

			$this->outputHTML( "<p><img src=\"" .$feed[0]->entities->media[0]->media_url_https. "\" alt=\"\"></p>" );

		}
	
	}

	public function outputGithub( $feed, $type ) {

		if ( $type == 'main' ) {

			$this->outputHTML ( "<p>" .$feed->type. " to repo <a href=https://github.com/" .$feed->repo->name. "\">" .$feed->repo->name. "</a> with message '" .$feed->payload->commits[0]->message. "'</p>" );
	
		} elseif ( $type == 'list' ) {

        		$this->outputHTML( "<a href=\"https://www.github.com/" .$feed->repo->name. "/commit/" .$feed->payload->commits[0]->sha. "\">" .substr( $feed->payload->commits[0]->sha, 0, 6 ). "</a> to repository <a href=\"https://www.github.com/" .$feed->repo->name. "\">" .$feed->repo->name. "</a>" );

		}

	}

	public function outputInstagram( $feed ) {

		$this->outputHTML( "<p><img src=\"" .$feed[0]->images->standard_resolution->url. "\" alt=\"" .$feed[0]->caption->text. "\"></p>" );
		$this->outputHTML( "<p>" .$feed[0]->caption->text. "</p>" );

	}

}
// Class Dismissed

?>
