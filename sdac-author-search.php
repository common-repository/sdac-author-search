<?php
/*
Plugin Name: SDAC Author Search
Plugin URI: http://www.sandboxdev.com/blog-and-cms-development/wordpress/wordpress-plugins/
Description: Logged in users get an option to search the site or only their published posts.
Author: Jennifer Zelazny/SDAC Inc.
Version: 1.0
Author URI: http://www.sandboxdev.com/
*/

/*
---------------------------------------------------
Released under the GPL license
http://www.opensource.org/licenses/gpl-license.php
---------------------------------------------------
This is an add-on for WordPress
http://wordpress.org/
---------------------------------------------------
This plugin is distributed  WITHOUT ANY WARRANTY; 
without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
---------------------------------------------------
*/

# ADD OPTION TO SEARCH LOGGED IN AUTHOR POSTS
add_filter( 'get_search_form', 'sdac_author_search' );
function sdac_author_search( $form ) {
	$form = '
	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    	<div>
    		<label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    		<input type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" />
    	';
	if (is_user_logged_in() ) {
    	global $current_user;
    	get_currentuserinfo();
    	$form .= '
    		<span class="author_search">
    			<input type="checkbox" class="author_search_input" name="author" value="' . $current_user->ID . '" />
    			<label for="author" class="author_search_label">' . __( 'Search My Posts Only' ) . '</label>
    		</span>
    	';
    }
		$form .='
			<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
		</div>
    </form>';

    return $form;
}
