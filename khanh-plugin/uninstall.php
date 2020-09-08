<?php
 // Trigger on Plugin uninstall

// Check security
if ( !defined('WP_UNINSTALL_PLUGIN') ){
    die;
}

// Cleared database data (single object)
// $books = get_posts( array('post_type' => 'book', 'numberposts' => -1) );
// 
// foreach( $books as $book ){
//     wp_delete_post( $book->ID, true );
// }


// A better way to delete CPT
// Access the database via SQL
global $wpdb;
// Delete books directly from database
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book';" );
// Delete post meta data
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
