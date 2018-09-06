<?php

// Enqueue UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'example_view_enqueue_uikit_assets' );

function example_view_enqueue_uikit_assets() {
    beans_uikit_enqueue_components( array( 'tooltip' ), 'add-ons' );
}

// Add tooltip attributes.
beans_add_attribute( 'beans_previous_link[_post_navigation]', 'data-uk-tooltip', "{pos:'top', animation:true, delay:200}" );
beans_add_attribute( 'beans_next_link[_post_navigation]', 'data-uk-tooltip', "{pos:'top', animation:true, delay:200}" );

// Load the document which is always needed at the bottom of template files.
beans_load_document();