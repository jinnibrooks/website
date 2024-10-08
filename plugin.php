<?php
/**
Plugin Name: Share on Tumbler
Plugin URI: http://yourls.org/
Description: Add <a href="http://tumblr.com">Tumblr</a> to the list of Quick Share destinations
Version: 1.0
Author: Ozh
Author URI: http://ozh.org/
**/


yourls_add_action( 'share_links', 'ozh_yourls_tumblr' );

function ozh_yourls_tumblr( $args ) {
	list( $longurl, $shorturl, $title, $text ) = $args;
	$shorturl = rawurlencode( $shorturl );
	$title = rawurlencode( htmlspecialchars_decode( $title ) );
	echo <<<TUMBLR
	
	<style type="text/css">
	#share_tb{background:transparent url(http://www.tumblr.com/favicon.ico) left center no-repeat;}
	</style>
	
	<a id="share_tb"
		href="http://www.tumblr.com/share?v=3&amp;u=$shorturl&amp;t=$title"
		title="Share on Tumblr"
		onclick="yourls_share_on_tumblr();return false;">Tumblr
	</a>
	
	<script type="text/javascript">
	// Send to Tumblr open window
	function yourls_share_on_tumblr() {
		var url = $('#share_tb').attr('href');
		window.open(url, 'tb', 'toolbar=no,width=800,height=550');
		return false;
	}
	// Dynamically update Tumblr link
	// when user clicks on the "Share" Action icon, event $('#tweet_body').keypress() is fired, so we'll add to this
	$('#tweet_body').keypress(function(){
		var title = encodeURIComponent( $('#titlelink').val() );
		var url = encodeURIComponent( $('#copylink').val() );
		var tb = 'http://www.tumblr.com/share?v=3&u='+url+'&t='+title;
		$('#share_tb').attr('href', tb);		
	});
	</script>

TUMBLR;
}