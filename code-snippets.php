<?php

/* code snippets file */


/* http://www.wpbeginner.com/wp-tutorials/display-the-last-updated-date-of-your-posts-in-wordpress/
function wpb_last_updated_date( $content ) {
$u_time = get_the_time('U'); 
$u_modified_time = get_the_modified_time('U'); 
if ($u_modified_time >= $u_time + 86400) { 
$updated_date = get_the_modified_time('F jS, Y');
$updated_time = get_the_modified_time('h:i a'); 
$custom_content .= '<p class="last-updated">Last updated on '. $updated_date . ' at '. $updated_time .'</p>';  
} 

    $custom_content .= $content;
    return $custom_content;
}
add_filter( 'the_content', 'wpb_last_updated_date' );
*/



// https://community.getbeans.io/discussion/how-to-show-post-excerpts/
add_filter( 'beans_post_meta_items', 'post_meta_items' );
function post_meta_items($items) {
    return array(
        'date' => 10,
        'author' => 20,
        'comments' => 30,
        'categories' => 40,
        'tags' => 50
        );
       
       /* Does this remove author? 
       unset( $items['author'] );
           return $items; */
       
}


// Remove the post meta categories below the content.
beans_remove_action( 'beans_post_meta_categories' );

// Remove the post meta tags below the content.
beans_remove_action( 'beans_post_meta_tags' );


// Adds the class post-meta-style to adjust the post meta information. Add > li and !important tag in the CSS for it to work.
beans_add_attribute( 'beans_post_meta', 'class', 'post-meta-style' );


/*--------- Adding Post meta icons. -----*/

// Adding an icon before the post meta date information. - https://community.getbeans.io/discussion/how-to-show-post-excerpts/
add_action( 'beans_post_meta_item[_date]_prepend_markup', 'post_meta_date_icon' );
function post_meta_date_icon() {
    ?><i class="uk-icon-clock-o uk-text-muted uk-margin-small-right"></i><?php

}

// Add icon - before author text
add_action( 'beans_post_meta_item[_author]_prepend_markup', 'post_meta_author_icon' );
function post_meta_author_icon() {
    ?><i class="uk-icon-user uk-text-muted uk-margin-small-right"></i><?php

}

// Add icon - before Leave a comment text
add_action( 'beans_post_meta_item[_comments]_prepend_markup', 'post_meta_comments_icon' );
function post_meta_comments_icon() {
    ?><i class="uk-icon-comment-o uk-text-muted uk-margin-small-right"></i><?php

}

// Add icon - before Filed under text
add_action( 'beans_post_meta_item[_categories]_prepend_markup', 'post_meta_folder_icon' );
function post_meta_folder_icon() {
    ?><i class="uk-icon-folder-o uk-text-muted uk-margin-small-right"></i><?php

}

// Add icon - before Tagged with text
add_action( 'beans_post_meta_item[_tags]_prepend_markup', 'post_meta_tags_icon' );
function post_meta_tags_icon() {
    ?><i class="uk-icon-tags uk-text-muted uk-margin-small-right"></i><?php

}



// Adjusts the Prefix of the single pages for: category, tag, author, post archive and taxonomy archive titles
function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( 'single cat or dog: ', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );






/*------- Widget information --------- */


// unregister some of the default widgets
 function remove_default_widgets() {
//   unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
//   unregister_widget('WP_Widget_Meta');
//   unregister_widget('WP_Widget_Search');
//   unregister_widget('WP_Widget_Text');
//   unregister_widget('WP_Widget_Categories');
//   unregister_widget('WP_Widget_Recent_Posts');
//   unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
//     unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'remove_default_widgets', 11);