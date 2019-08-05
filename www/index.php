<?php

	include_once( '../config.php' );
	include_once( 'include.php' );
	include_once( 'pre.php' );

	if ( $location != 'local' ) {
		$memcache = new Memcache;
	}

/*
	//$seti = new RPC;

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
				<p style=\"text-align:right\">23rd May 2018</P>
				<p>What is Old is New (Again)</p> 
				<p>It is hard to believe that I’ve been maintaining a personal website in one form or another for over 20 years. Or that almost 10 years has passed since I last reorganized and redesigned it. Or that 3 years have passed since the last blog entry.</p>
				<p>So here we are, the beginning of something new. Not sure exactly where this will end up, but here we go, the beginning of something new.</p>
				<p>Meanwhile, elsewhere on the web…</p>
				<p><ul>
					<li><a href=\"http://pdw.weinstein.org/about/index.html\" alt\"Personal Blog\">Blog</a></li>
<!---					<li><a href=\"\">Boinc<ul><li> --->
	");
	
	//echo $seti->getResults();
	
	$template->outputHTML("	
					<li><a href=\"https://www.github.com/pdweinstein\" alt\"GitHub\">GitHub</a><ul><li>Last commit was
	");					
	
	$template->outputHTML( "<a href=\"https://www.github.com/" .$GHrecent->repo->name. "/commit/" .$GHrecent->payload->commits[0]->sha. "\">" .substr( $GHrecent->payload->commits[0]->sha, 0, 6 ). "</a> to repository <a href=\"https://www.github.com/" .$GHrecent->repo->name. "\">" .$GHrecent->repo->name. "</a>"  ); 
					
	$template->outputHTML("
					</li></ul>					
					<li><a href=\"https://www.goodreads.com/author/show/193451.Paul_Weinstein\" alt\"Goodreads\">Goodreads</a> <ul> <li> Currently reading 
	");

	$book = $books[0];	
	$template->outputHTML( "<a href='" .$book->link. "' alt='" .$book->title. "'> " .$book->title. " </a>");
	$template->outputHTML("
					</li></ul>
					<li><a href=\"https://www.facebook.com/pdweinstein\" alt\"Facebook\">Facebook</a></li>
					<li><a href=\"https://www.flickr.com/photos/pdweinstein\" alt\"Flickr\">Flickr</a><ul><li>Latest photo:
	");

	$template->outputHTML( "<a href='https://www.flickr.com/photos/pdweinstein/" .$recent['photos']['photo'][0]['id']. "/in/photostream/' alt='" .$recent['photos']['photo'][0]['title']. "'>" .$recent['photos']['photo'][0]['title']. "</a>");

	$template->outputHTML("
					</li></ul>
					<li><a href=\"https://www.instagram.com/pdweinstein\" alt\"Instagram\">Instagram</a><ul><li>Latest photo:
	");

	$template->outputHTML( "<a href='" .$instaData[0]->{'link'}. "' alt='" .$instaData[0]->{'caption'}->{'text'}. "'>" .$instaData[0]->{'caption'}->{'text'}. "</a>" );
 
	$template->outputHTML("
					</li></ul>					
					<li><a href=\"https://www.linkedin.com/in/pdweinstein\" alt\"LinkedIn\">LinkedIn</a></li>
					<li><a href=\"https://www.reddit.com/user/pdweinstein\" alt\"Reddit\">Reddit</a></li>
				<li><a href=\"https://twitter.com/pdweinstein\" alt\"Twitter\">Twitter</a><ul><li>
	");

	$tweet = $tweets[0];
	$template->outputHTML( "<a href='https://twitter.com/pdweinstein/status/" .$tweet->id_str. "' alt='" .$tweet->text. "'> Latest Tweet:</a> " .$tweet->text. "</li></ul>");

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