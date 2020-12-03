<?php

/*
 *   @package		outside-php
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
class outside {

	// Setup class vars
	var $debug = false;
	
	/**
	 *	__construct function, let's get this object created.
	 * 
	 *	@access	public
	 */
	public function __construct( $debug = false ) {
	
		$this->debug = $debug;	
	
	}
	
	public function getGitHubEvents() {
		
		#$events = simplexml_load_file( 'https://api.github.com/users/pdweinstein/events/public' );
	
		#$feed = file_get_contents( 'https://api.github.com/users/pdweinstein/events/public' );
		$feed = $this->fetchURL( 'https://api.github.com/users/pdweinstein/events/public' );
		$events = json_decode( $feed );
		
		return $events;
		
	}
	
        function fetchURL( $url ){
	    		
            $curl_handle=curl_init();
            curl_setopt( $curl_handle, CURLOPT_URL, $url );
            curl_setopt( $curl_handle, CURLOPT_CONNECTTIMEOUT, 2 );
            curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $curl_handle, CURLOPT_USERAGENT, 'PHP cURL' );
            $query = curl_exec( $curl_handle );
            curl_close( $curl_handle );
							
            return $query;
					
	}


    function cmp( $a, $b ) {

    	return strcmp($b["played"][0], $a["played"][0]) ;

    }

    function xml2array( $fname ){

    	$sxi = new SimpleXmlIterator( $fname, null, true );

		return $this->sxiToArray($sxi);

    }

    function sxiToArray( $sxi ){

        $a = array();

        for( $sxi->rewind(); $sxi->valid(); $sxi->next() ) {

                if(!array_key_exists($sxi->key(), $a)){

                        $a[$sxi->key()] = array();

                }

                if($sxi->hasChildren()){

                        $a[$sxi->key()][] = $this->sxiToArray($sxi->current());

                } else {

                        $a[$sxi->key()][] = strval($sxi->current());

                }

        }

        return $a;

    }


}
// Class Dismissed

?>
