<?php

	include_once( 'view/server/class.template.php' );
	$template = new Template;
	
	// First output our page header			   
	$template->outputHTML( "<html> \n \t<head>\n" );
	$template->outputMeta( $template->meta );	

	$template->outputHTML( "\n\t\t<title>" );
	$template->outputString( "Paul Weinstein" );
	$template->outputHTML( "</title>\n\n" );

?>
