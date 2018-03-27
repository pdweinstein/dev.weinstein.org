<?php

	include_once( 'view/server/php/class.template.php' );
	$template = new Template;
	
	// First output our page header			   
	$template->outputHTML( "<html><head>\n" );
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
					<li><a href=\"https://www.github.com/pdweinstein\" alt\"GitHub\">GitHub</a></li>
					<li><a href=\"https://www.goodreads.com/author/show/193451.Paul_Weinstein\" alt\"Goodreads\">Goodreads</a></li>
					<li><a href=\"https://plus.google.com/u/0/104233578006014995011\" alt\"Google+\">G+</a></li>
					<li><a href=\"https://www.facebook.com/pdweinstein\" alt\"Facebook\">Facebook</a></li>
					<li><a href=\"https://www.flickr.com/photos/pdweinstein\" alt\"Flickr\">Flickr</a></li>
					<li><a href=\"https://www.linkedin.com/in/pdweinstein\" alt\"LinkedIn\">LinkedIn</a></li>
					<li><a href=\"https://www.reddit.com/user/pdweinstein\" alt\"Reddit\">Reddit</a></li>
					<li><a href=\"https://twitter.com/pdweinstein\" alt\"Twitter\">Twitter</a></li>
					<li><a href=\"https://www.youtube.com/user/pdweinstein\" alt\"YuouTube\">YouTube</a></li>
				</ul></p>
				<p>- Paul </p>
		</div>
	</div>
	<nav class=\"navbar fixed-bottom navbar-light bg-light\">
		<p>
			]LOAD WWW.WEINSTEIN.ORG <br/> ]RUN <br/> COPYRIGHT PAUL WEINSTEIN (c) 1997 - 2018
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