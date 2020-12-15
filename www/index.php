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
    <div class=\"desktop\">
        <div class=\"icon\"><a href=\"https://www.weinstein.org/\"><img src='/media/png/hd.png' alt='Home'></a></div>
        <div class=\"iconText\"><a href=\"https://www.weinstein.org/\">Home</div></a>
        <br/>
        <div class=\"icon adIcon\"><a href=\"#\"><img src='/media/png/floppy.png' alt='AfterDark'></a></div>
        <div class=\"iconText adIcon\"><a href=\"#\">After Dark</div></a>
    </div>
    <div class=\"window ad\">
        <div class=\"bar title\">
            <h1>After Dark</h1>
            <nav>
                <ul>
                    <li class=\"close adc\"></li>
                </ul>
            </nav>
        </div>
        <div>
           <div class=\"finder\">
               <div class=\"row\">
                   <div class=\"col-sm-4 col-md-2\" >
                       <div class=\"icon afIcon\"><a href=\"after-dark/bouncing-ball.html\"><img src='/media/png/app.png' alt='Bouncing Ball'></a></div>
                       <div class=\"iconText afIcon\"><a href=\"after-dark/bouncing-ball.html\">Bouncing Ball</div></a>
                   </div>
                   <div class=\"col-sm-4 col-md-2 col-md-push-2\" >
                         <div class=\"icon afIcon\"><a href=\"after-dark/fade-out.html\"><img src='/media/png/app.png' alt='Fade Out'></a></div>
                         <div class=\"iconText afIcon\"><a href=\"after-dark/fade-out.html\">Fade Out</div></a>
                   </div>
                   <div class=\"col-sm-4 col-md-2 col-md-push-6\" >
                         <div class=\"icon afIcon\"><a href=\"after-dark/fish.html\"><img src='/media/png/app.png' alt='Fish'></a></div>
                         <div class=\"iconText afIcon\"><a href=\"after-dark/fish.html\">Fish</div></a>
                   </div>
                   <div class=\"col-sm-4 col-md-2 col-m d-pull-4\" >
                         <div class=\"icon afIcon\"><a href=\"after-dark/flying-toasters.html\"><img src='https://storage.googleapis.com/personal-dev-site.appspot.com/view/client/png/app.png' alt='Flying Toaster'></a></div>
                         <div class=\"iconText afIcon\"><a href=\"after-dark/flying-toasters.html\">Flying Toasters</div></a>
                   </div>
                   <div class=\"col-sm-4 col-md-2 col-md-pull-4\" >
                         <div class=\"icon afIcon\"><a href=\"after-dark/globe.html\"><img src='/media/png/app.png' alt='Globe'></a></div>
                         <div class=\"iconText afIcon\"><a href=\"after-dark/globe.html\">Globe</div></a>
                   </div>
                   <div class=\"col-sm-4 col-md-2\" >
                         <div class=\"icon afIcon\"><a href=\"after-dark/hard-rain.html\"><img src='/media/png/app.png' alt='Hard Rain'></a></div>
                         <div class=\"iconText afIcon\"><a href=\"after-dark/hard-rain.html\">Hard Rain</div></a>
                   </div>
               </div>
               <div class=\"row\">
                    <div class=\"col-sm-4 col-md-2\" >
                        <div class=\"icon afIcon\"><a href=\"after-dark/rainstorm.html\"><img src='/media/png/app.png' alt='Rainstorm'></a></div>
                        <div class=\"iconText afIcon\"><a href=\"after-dark/rainstorm.html\">Rainstorm</div></a>
                    </div>
                    <div class=\"col-sm-4 col-md-2 col-md-push-2\" >
                       <div class=\"icon afIcon\"><a href=\"after-dark/spotlight.html\"><img src='/media/png/app.png' alt='Spotlight'></a></div>
                        <div class=\"iconText afIcon\"><a href=\"after-dark/spotlight.html\">Spotlight</div></a>
                    </div>
                    <div class=\"col-sm-4 col-md-2 col-md-push-6\" >
                        <div class=\"icon afIcon\"><a href=\"after-dark/logo.html\"><img src='/media/png/app.png' alt='Logo'></a></div>
                        <div class=\"iconText afIcon\"><a href=\"after-dark/logo.html\">Logo</div></a>
                    </div>
                    <div class=\"col-sm-4 col-md-2 col-md-pull-4\" >
                        <div class=\"icon afIcon\"><a href=\"after-dark/messages.html\"><img src='/media/png/app.png' alt='Messages'></a></div>
                        <div class=\"iconText afIcon\"><a href=\"after-dark/messages.html\">Messages</div></a>
                    </div>
                    <div class=\"col-sm-4 col-md-2 col-md-pull-4\" >
                        <div class=\"icon afIcon\"><a href=\"after-dark/messages2.html\"><img src='/media/png/app.png' alt='Messages 2'></a></div>
                        <div class=\"iconText afIcon\"><a href=\"after-dark/messages2.html\">Messages 2</div></a>
                    </div>
                    <div class=\"col-sm-4 col-md-2\" >
                        <div class=\"icon afIcon\"><a href=\"after-dark/warp.html\"><img src='/media/png/app.png' alt='Warp'></a></div>
                        <div class=\"iconText afIcon\"><a href=\"after-dark/warp.html\">Warp</div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

		$template->outputInstagram( $feed['instagram'], 'main' );

	} elseif( $latest == 'blog' ) {

		$template->outputBlog( $feed['blog'] );

    } elseif( $latest == 'reddit' ) {

        $template->outputReddit( $feed['reddit'], 'main' );

}

    $template->outputHTML("
				<p>Elsewhere:</p>
				<p><ul>
					<li><a href=\"/blog/\" alt\"Personal Blog\">Blog</a><ul><li><a href=\"" .$bPost->link['href']. "\">" .(string) $bPost->title. "</a></li></ul></li>
<!---					<li><a href=\"\">Boinc<ul><li> --->
	");		

	$template->outputHTML("
					<li><a href=\"https://www.github.com/pdweinstein\" alt\"GitHub\">GitHub</a>
	");
	$template->outputGithub( $feed['github'], 'list' );	
					
	$template->outputHTML("					
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
					<li><a href=\"https://www.instagram.com/pdweinstein\" alt\"Instagram\">Instagram</a>
	");
	$template->outputInstagram( $feed['instagram'], 'list' );

	$template->outputHTML("				
					<li><a href=\"https://www.linkedin.com/in/pdweinstein\" alt\"LinkedIn\">LinkedIn</a></li>
					<li><a href=\"https://www.reddit.com/user/pdweinstein\" alt\"Reddit\">Reddit</a></li>
	");

    $template->outputReddit( $feed['reddit'], 'list' );

    $template->outputHTML("				
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
			]LOAD WWW.WEINSTEIN.ORG <br/> ]RUN <br/> COPYRIGHT PAUL WEINSTEIN (c) 1997 - 2020
		</p>
	</nav>
	");

	// Put JS load code at end of doc to keep everything quick for 
	// page load
	$template->outputJS( $template->js );
	// Local JS code
	echo "
    <script> 
        $( \".window\" ).draggable();
        $( \".ad\" ).hide();
        $( \".adIcon\" ).click(function( event ) {
            event.preventDefault();
            $( \".ad\" ).show( \"scale\", { percent: 0 }, 500 );
        });
        $( \".adc\" ).click(function( event ) {
            event.preventDefault();
            $( \".ad\" ).hide( \"scale\", { percent: 0 }, 500 );
        });
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '" .$gAnalyticsID. "');
    </script>";
	$template->outputHTML( "</body></html>" );

?>
