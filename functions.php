<?php

// Include Beans. Do not remove the line below.
require_once( get_template_directory() . '/lib/init.php' );

/*
 * Remove this action and callback function if you do not whish to use LESS to style your site or overwrite UIkit variables.
 * If you are using LESS, make sure to enable development mode via the Admin->Appearance->Settings option. LESS will then be processed on the fly.
 */

/* I am not using style.less.
add_action( 'beans_uikit_enqueue_scripts', 'beans_child_enqueue_uikit_assets' );
function beans_child_enqueue_uikit_assets() {
	beans_compiler_add_fragment( 'uikit', get_stylesheet_directory_uri() . '/style.less', 'less' );

}
*/


// Include when using style.css. Added filemtime to right away force CSS changes.
// Remove this action and callback function if you are not adding CSS in the style.css file.
add_action( 'wp_enqueue_scripts', 'beans_child_enqueue_assets' );
function beans_child_enqueue_assets() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
}


/* ---------- CUSTOM CODE ------ */


// Include php files 
include_once( get_stylesheet_directory() . '/code-snippets.php' );
include_once( get_stylesheet_directory() . '/widget-sections.php' );


// Add support for editor stylesheet - using twenty Sixteens editor stylesheet.
add_editor_style( 'editor-style.css' );

// Remove beans editor styling
beans_remove_action( 'beans_add_editor_assets' );

//Removes uk-container from header area.
beans_remove_attribute( 'beans_fixed_wrap[_header]', 'class', 'uk-container' );
//beans_add_attribute( 'beans_primary_menu', 'class', 'uk-container' );


// Removes comments on pages
beans_add_smart_action( 'init', 'banks_post_type_support' );
function banks_post_type_support() {
	remove_post_type_support( 'page', 'comments' );
}


// Remove the page title from all pages except the blog page. 
// https://community.getbeans.io/discussion/remov-title-and-change-archive-h1/ ----*/
add_action( 'wp', 'setup_document_remove_pagetitle' );
function setup_document_remove_pagetitle() {
    if ( false === is_single() and !is_home()  ) { 
        beans_remove_action( 'beans_post_title' );
    }
}

// Removes site description
// beans_remove_action( 'beans_site_title_tag' );

// Remove breadcrumbs.
add_filter( 'beans_pre_load_fragment_breadcrumb', '__return_true' );



/* -------- FEATURED IMAGE --------*/

// Resize the featured images on the blog and single post page 
add_filter( 'beans_edit_post_image_args', 'example_post_image_edit_args' );
function example_post_image_edit_args( $args ) {
    return array_merge( $args, array(
        'resize' => array( 1600, 300, true ),
    ) );
}

/* ----  Removes featured image on single post AND a page.
https://community.getbeans.io/discussion/hiding-featured-image-on-specific-page/#post-2826 ---*/
add_action( 'wp', 'beans_child_setup_document' );
function beans_child_setup_document() {
   if ( is_single() or is_page() ) {                    
        beans_remove_action( 'beans_post_image' );
    }
}



// Blog page Excerpt 
// https://community.getbeans.io/discussion/how-to-show-post-excerpts/
add_filter( 'the_content', 'beans_child_modify_post_content' );
function beans_child_modify_post_content( $content ) {
 // Stop here if we are on a single view.
 if ( is_singular() )
 return $content;
 // Return the excerpt() if it exists other truncate.
 if ( has_excerpt() )
 $content = '<p>' . get_the_excerpt() . '</p>';
 else
 $content = '<p>' . wp_trim_words( get_the_content(), 40, '...' ) . '</p>';
 // Return content and readmore.
 return $content . '<p>' . beans_post_more_link() . '</p>';
}


// Display posts in a responsive grid.
/* http://www.getbeans.io/code-snippets/display-posts-in-a-responsive-grid/ and https://getuikit.com/v2/docs/grid.html */
add_action( 'wp', 'the_posts_grid' );

function the_posts_grid() {
	// Only apply to non singular view.
	if ( !is_singular() ) {

		// Add grid.
		beans_wrap_inner_markup( 'beans_content', 'beans_child_posts_grid', 'div', array(
			'class' => 'uk-grid uk-grid-match',
			'data-uk-grid-margin' => ''
		) );
		beans_wrap_markup( 'beans_post', 'beans_child_post_grid_column', 'div', array(
			'class' => 'uk-width-large-1-2 uk-width-medium-1-2'
		) );

		// Move the posts pagination after the new grid markup.
		beans_modify_action_hook( 'beans_posts_pagination', 'beans_child_posts_grid_after_markup' );		
	}
}



/* ------- In a post: Adds new classes to post meta, post category and changes the color of the post comment button. 
In a post/page: Adds a class to create a full width header, so the menu is full width.
Find the Data Markup ID for each area. Example beans_post_meta. A new class of post_meta is created.  ----*/

// Adds the class post-meta to style the meta area right after the title and before the content of a post.
beans_add_attribute( 'beans_post_meta', 'class', 'post_meta' );

// Adds the class post_category to style the meta area after the content. 
//beans_add_attribute( 'beans_post_meta_categories', 'class', 'post_category' );

// Changes the default button color from .uk-button-primary to .uk.button-sucess: https://getuikit.com/v2/docs/button.html
//beans_add_attribute( 'beans_comment_form_submit', 'class', 'uk-button-success' );

// Adds the class header-full to give a full width to the header
//beans_add_attribute( 'beans_fixed_wrap[_header]', 'class', 'header-full' );





/* -------- Adjusted comment language --------*/

// Modify the "No comment yet, add your voice below!" text.
add_filter( 'beans_no_comment_text_output', 'modify_no_comments_yet' );
function modify_no_comments_yet() {
   return 'Be the first to add a comment! 🐶';
}



/* ------------- Adding additional menus 
https://community.getbeans.io/discussion/menu-question/  ---------------*/

// Register new Menus
function register_multiple_menus() {
  register_nav_menus(
    array(
      'preheader-menu' => __( 'Preheader menu' ),
      'secondary-menu' => __( 'Secondary Menu' ),
      'footer-menu' => __( 'Footer menu' ),
    )
 );
}
add_action( 'init', 'register_multiple_menus' );


// Add the new preheader menu - where it is to be located
 beans_add_smart_action( 'beans_header_before_markup', 'preheader_menu' );

function preheader_menu() {
   if ( has_nav_menu( 'preheader-menu' ) ) { // only show if the  location preheader-menu has a menu assigned
 wp_nav_menu( array(
 'menu' => 'Preheader Menu',
 'menu_class' => 'preheader-menu', // I added my own class to the menu.
 'container' => 'nav',
 'container_class' => 'uk-navbar uk-float-center',
 'theme_location' => 'preheader-menu',
 'beans_type' => 'navbar'
   ) );
   }
}


// Add the new secondary menu - where it is to be located
 beans_add_smart_action( 'beans_header_after_markup', 'secondary_menu' );

function secondary_menu() {
 if ( has_nav_menu( 'secondary-menu' ) ) { // only show if the location secondary-menu has a menu assigned
 echo beans_open_markup( 'secondary_menu_nav', 'div', 'class=secondary-menu' );
 wp_nav_menu( array(
     'menu' => 'Secondary',
     'menu_class' => 'uk-navbar-nav uk-visible-larget',
     'container' => 'nav',
     'container_class' => 'uk-container uk-container-center uk-navbar',
     'theme_location' => 'secondary-menu',
     'beans_type' => 'navbar'
   ) );
   echo beans_close_markup( 'secondary_menu_nav', 'div' );
   }
 }


// Add the new footer menu - where it is to be located
 beans_add_smart_action( 'beans_fixed_wrap[_footer]_prepend_markup', 'footer_menu' );

/* Overwrite the footer credit and add the footer menu
 beans_add_smart_action( 'beans_footer_credit_right_text_output', 'footer_menu' );
 */

function footer_menu() {

wp_nav_menu( array(
 'menu' => 'Footer Menu',
 'menu_class' => 'uk-subnav uk-container uk-container-center',
 'theme_location' => 'footer-menu',
 'beans_type' => 'navbar'
 ) );
 }

// So we get the menu in the correct location
 beans_remove_attribute( 'beans_menu[_navbar][_footer-menu]', 'class', 'uk-navbar-nav' );



/*----- COPYRIGHT INFO BOTTOM - 
https://community.getbeans.io/discussion/customizing-the-footer-copyright-information/ -----*/

// Overwrite the footer content.
beans_modify_action_callback( 'beans_footer_content', 'beans_child_footer_content' );

// COPYRIGHT area
function beans_child_footer_content() {
?>
<div class="tm-sub-footer uk-text-center">
 <p>© <?php echo date('Y'); ?>
 Made by 
<a href="<?php echo esc_url( site_url() );?>" target="_blank" title="A Beans WordPress Framework"> Paal Joachim.</a> 
With the <a href="http://www.getbeans.io/" title="Beans Framework for WordPress" target="_blank">Beans WordPress Framework</a>. 
 - <a href="<?php echo admin_url();?>" title="Go to the WordPress Backend" />Login</a></p>
 </div>
 <?php
}

beans_add_attribute( 'beans_fixed_wrap[_footer]', 'class', 'copyright-footer-full' );




    