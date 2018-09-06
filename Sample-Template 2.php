<?php
/* Template Name: Sample Template */

add_action( 'beans_main_grid_before_markup', 'example_teaser_post' );

function example_teaser_post() {

    global $post;

    // Stop here if the post couldn't be fetched.
    if ( !$post = get_post( 2 ) )
        return;

    // Setup post data.
    $post = $get_post;
    setup_postdata( $post );

    ?>
    <article class="uk-article uk-panel-box">
        <header>
            <h1 class="uk-article-title"><?php the_title(); ?></h1>
        </header>
        <div class="tm-article-content">
            <?php the_content(); ?>
        </div>
    </article>
    <?php

    wp_reset_postdata();

}

// Since we added a post above the grid, let's add a uk-grid-margin to the main grid to space it properly.
beans_add_attribute( 'beans_main_grid', 'class', 'uk-grid-margin' );

// Load the document which is always needed at the bottom of page templates.
beans_load_document();