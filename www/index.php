<?php

	include_once( '../config.php' );
	include_once( '../lib/include.php' );
	include_once( '../lib/pre.php' );
/*
	if ( $location != 'local' ) {
		$memcache = new Memcache;
	}

	$seti = new RPC;

        $goodReads = new goodReads( $goodreads_token, $goodreads_user_id, $goodreadsOptions, true);
        $books = $goodReads->getShelf();

	$twitter = new TwitterAPIExchange( $twitterSettings );

	$flickr = new phpFlickr( FLICKR_API );

	$elsewhere = new Outside;
*/
	$template = new Template;
	// First output our page header			   
	$template->outputHTML( "<html xmlns='http://www.w3.org/1999/xhtml' xmlns:fb='http://ogp.me/ns/fb#'><head>\n" );
	$template->outputMeta( $template->meta );	

	$template->outputHTML( "<title>" );
	$template->outputString( "Paul Weinstein" );
	$template->outputHTML( "</title>" );

	$template->outputlink( $template->link );	

	// Now we move onto the HTML body
	$template->outputHTML( "</head><body>" );

	$template->outputHTML("
	<div class=\"window\">
		<div class=\"bar title\">
			<h1>WWW.WEINSTEIN.ORG</h1>
			<nav>
				<ul>
					<li class=\"close\"></li>
				</ul>
			</nav>
		</div>
		<div class=\"msg\">
				<p style=\"text-align:right\">$latestDate</p>
				<p>Latest Post: " .ucfirst( $latest ). "</p> 
	");

	if( $latest == 'flickr' ) {
	
		$template->outputFlickr( $feed['flickr'] );

	} elseif( $latest == 'twitter' ) {

		$template->outputTweet( $feed['twitter'], 'main' );

	} elseif( $latest == 'github' ) {

		$template->outputGithub( $feed['github'], 'main' );

	} elseif( $latest == 'instagram' ) {

		$template->outputInstagram( $feed['instagram'] );

	}

	$template->outputHTML("
				<p>Elsewhere:</p>
				<p><ul>
					<li><a href=\"/blog/\" alt\"Personal Blog\">Blog</a><ul><li><a href=\"/blog/index.php/2018/05/what-is-old-is-new-again.html\">What is Old is New (Again)</a></li></ul></li>
<!---					<li><a href=\"\">Boinc<ul><li> --->
	");
	
	//echo $seti->getResults();
	
	$template->outputHTML("	
					<li><a href=\"https://www.github.com/pdweinstein\" alt\"GitHub\">GitHub</a><ul><li>Last commit was
	");					

	$template->outputGithub( $feed['github'], 'list' );	
					
	$template->outputHTML("
					</li></ul>					
					<li><a href=\"https://www.goodreads.com/author/show/193451.Paul_Weinstein\" alt\"Goodreads\">Goodreads</a> <ul> <li> Currently reading 
	");

	$template->outputHTML( "<a href='" .$book['link']. "' alt='" .$book['title']. "'> " .$book['title']. " </a>");
	$template->outputHTML("
					</li></ul>
					<li><a href=\"https://www.facebook.com/pdweinstein\" alt\"Facebook\">Facebook</a></li>
	");
/*
	$postData = "";
	$userPosts = $fb->get("/526081044/feed", $accessToken);
	$postBody = $userPosts->getDecodedBody();
	$postData = $postBody["data"];

	if (! empty($postData)) {

		foreach ($postData as $k => $v) {

			$postDate = date("d F, Y", strtotime($postData[$k]["created_time"]));

			if(!empty($postData[$k]["message"])) { 
echo $postData[$k]["message"]; 
				echo $postDate;
    			}
		}
	}
 */
	$template->outputHTML("
					<li><a href=\"https://www.flickr.com/photos/pdweinstein\" alt\"Flickr\">Flickr</a><ul><li>
	");

	$template->outputHTML( "<a href='https://www.flickr.com/photos/pdweinstein/" .$recent['photos']['photo'][0]['id']. "/in/photostream/' alt='" .$recent['photos']['photo'][0]['title']. "'>" .$recent['photos']['photo'][0]['title']. "</a>");

	$template->outputHTML("
					</li></ul>
					<li><a href=\"https://www.instagram.com/pdweinstein\" alt\"Instagram\">Instagram</a><ul><li>
	");

	$template->outputHTML( "<a href='" .$instaData[0]->{'link'}. "' alt='" .$instaData[0]->{'caption'}->{'text'}. "'>" .$instaData[0]->{'caption'}->{'text'}. "</a>" );
 
	$template->outputHTML("
					</li></ul>					
					<li><a href=\"https://www.linkedin.com/in/pdweinstein\" alt\"LinkedIn\">LinkedIn</a></li>
					<li><a href=\"https://www.reddit.com/user/pdweinstein\" alt\"Reddit\">Reddit</a></li>
				<li><a href=\"https://twitter.com/pdweinstein\" alt\"Twitter\">Twitter</a><ul><li>
	");

	$template->outputTweet( $feed['twitter'], 'list' );
 	$template->outputHTML( "</li></ul>" );

	$template->outputHTML("
					<li><a href=\"https://www.youtube.com/user/pdweinstein\" alt\"YouTube\">YouTube</a></li>
				</ul></p>
		</div>
	</div>
	<nav class=\"navbar fixed-bottom navbar-light bg-light\">
		<p>
			]LOAD WWW.WEINSTEIN.ORG <br/> ]RUN <br/> COPYRIGHT PAUL WEINSTEIN (c) 1997 - 2019
		</p>
	</nav>
	");

	// Put JS load code at end of doc to keep everything quick for 
	// page load
	$template->outputJS( $template->js );
	// Local JS code
	echo "<script> 
		$(\".window\").draggable().resizable({
			resize: function(event, ui) {
				$(this).css({left:'20%'});
			}
		});
	</script>";
	$template->outputHTML( "</body></html>" );

?>
