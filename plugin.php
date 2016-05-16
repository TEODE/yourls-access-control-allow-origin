<?php
/*
Plugin Name: Access Control Allow Origin
Plugin URI: http://yourls.org/
Description: Prevents CORS issue with domain CNAMES and aliases for admin actions
Version: 1.0
Author: Vincent Giraud
Author URI: http://teode.com/
*/
// No direct call
if( !defined( 'YOURLS_SITE' ) ) die();

// Kick in if the loader does not recognize a valid pattern
yourls_add_action( 'content_type_header', 'vg_yourls_cors' );

function vg_yourls_cors($type) {
    if( !headers_sent() ) {
        $charset = yourls_apply_filter( 'content_type_header_charset', 'utf-8' );
        $types = implode("; ", $type);
        header( "Content-Type: $types; charset=$charset" );
        $domain = parse_url(YOURLS_SITE);
        $fqdn = $domain['scheme']."://".$domain['host'];
        header("Access-Control-Allow-Origin: ".$fqdn);
        return true;
    }
    return false;
}
?>