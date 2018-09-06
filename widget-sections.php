<?php

/*
http://www.getbeans.io/code-reference/functions/beans_register_widget_area/

beans_type options: stack, grid (default) or offcanvas.

http://www.getbeans.io/code-reference/structure/
Hooks:
beans_header
beans_main_grid_before_markup
beans_before_loop
beans_before_posts_loop

beans_post_header
beans_post_body

beans_content

beans_sidebar_primary
beans_sidebar_secondary

beans_no_post
beans_after_posts_loop
beans_after_loop

beans_comment_header
beans_comment_content
beans_no_comment
beans_comments_closed
beans_after_open_comments

beans_before_widgets_loop
beans_widget
beans_no_widget
beans_after_widgets_loop

beans_main_grid_after_markup
beans_footer_before_markup
beans_footer_after_markup
beans_footer

*/


/*------- New Widget Locations ----------*/

/* Default widget code which was below each widget section Here is the header widget. It is replaced with a display code instead. --

add_action( 'beans_header', 'beans_child_header_widget_area' );
function beans_child_header_widget_area() {
	echo beans_widget_area( 'header' );
} */


/*--- Above Header Widget ----*/
add_action( 'widgets_init', 'beans_child_widget_above_header' );
function beans_child_widget_above_header() {
    beans_register_widget_area( array(
        'name' => 'Above Header',
        'id' => 'above-header',
        'description' => 'Widgets in this area will be shown above the header section as a grid.',
        'beans_type' => 'grid'
    ) );
}

/* Display the above header widget area in the front end. */
add_action( 'beans_header_before_markup', 'beans_child_above_header_widget_area' );
	function beans_child_above_header_widget_area() {
	?>
		<div class="widget-above-header">
			<div class="uk-container uk-container-center">
				<?php echo beans_widget_area( 'above-header' ); ?>
			</div>
		</div>
		<?php
}



/*--- Header Widget ----*/
add_action( 'widgets_init', 'beans_child_widgets_header' );
function beans_child_widgets_header() {
    beans_register_widget_area( array(
        'name' => 'Header',
        'id' => 'header',
        'description' => 'Widgets in this area will be shown in the header section as a grid.',
        'beans_type' => 'grid'
    ) );
}

// Display the header widget area in the front end.
add_action( 'beans_header', 'beans_child_header_widget_area' );
	function beans_child_header_widget_area() {
	?>
		<div class="widget-header uk-block">
			<div class="uk-container uk-container-center">
				<?php echo beans_widget_area( 'header' ); ?>
			</div>
		</div>
		<?php
}
	



/*---- Hero Widget ----*/
add_action( 'widgets_init', 'beans_child_widgets_init' );
function beans_child_widgets_init() {
    beans_register_widget_area( array(
        'name' => 'Hero',
        'id' => 'hero',
        'description' => 'Widgets in this area will be shown in the hero section as a grid.',
        'beans_type' => 'grid'
    ) );
}

// Display hero widget area in the front end 
add_action( 'beans_main_grid_before_markup', 'beans_child_hero_widget_area' );
function beans_child_hero_widget_area() {
	?>
	<div class="widget-hero uk-block">
		<div class="uk-container uk-container-center">
			<?php echo beans_widget_area( 'hero' ); ?>
		</div>
	</div>
	<?php
}


/*------- Content Header -------*/
add_action( 'widgets_init', 'beans_child_widgets_post_header_loop' );
function beans_child_widgets_post_header_loop() {
    beans_register_widget_area( array(
        'name' => 'Content Header',
        'id' => 'content-header',
        'description' => 'Widgets in this area will be shown in the before content section as a grid.',
        'beans_type' => 'grid'
    ) );
}

// Display the content widget area in the front end.
add_action( 'beans_post_header', 'beans_child_post_header_widget_area' );
	function beans_child_post_header_widget_area() {
	?>
		<div class="widget-content-header">
			<div class="uk-container uk-container-center">
				<?php echo beans_widget_area( 'content-header' ); ?>
			</div>
		</div>
		<?php
}



/*------- Before Content widget -------*/
add_action( 'widgets_init', 'beans_child_widgets_post_body_loop' );
function beans_child_widgets_post_body_loop() {
    beans_register_widget_area( array(
        'name' => 'Before Content',
        'id' => 'before-content',
        'description' => 'Widgets in this area will be shown in the before post_body section as a grid.',
        'beans_type' => 'grid'
    ) );
}

// Display the content widget area in the front end.
add_action( 'beans_post_body', 'beans_child_post_body_widget_area' );
	function beans_child_post_body_widget_area() {
	?>
		<div class="widget-before-content">
			<div class="uk-container uk-container-center">
				<?php echo beans_widget_area( 'before-content' ); ?>
			</div>
		</div>
		<?php
}



/*------- After content widget - also after comment in post ---------*/
add_action( 'widgets_init', 'beans_child_widgets_content' );
function beans_child_widgets_content() {
    beans_register_widget_area( array(
        'name' => 'After Content',
        'id' => 'after-content',
        'description' => 'Widgets in this area will be shown in the after content section as a grid.',
        'beans_type' => 'grid'
    ) );
}


// Display the content widget area in the front end.
add_action( 'beans_content', 'beans_child_content_widget_area' );
	function beans_child_content_widget_area() {
	?>
		<div class="widget-after-content">
			<div class="uk-container uk-container-center">
				<?php echo beans_widget_area( 'after-content' ); ?>
			</div>
		</div>
		<?php
}

/* Default widget code --
add_action( 'beans_content', 'beans_child_content_widget_area' );
function beans_child_content_widget_area() {
	echo beans_widget_area( 'content' );
}*/




/* After content widget */
add_action( 'widgets_init', 'beans_child_widgets_after' );
function beans_child_widgets_after() {
    beans_register_widget_area( array(
        'name' => 'After Content 2',
        'id' => 'after-content2',
        'description' => 'Widgets in this area will be shown in the after content 2 section as a grid.',
        'beans_type' => 'grid'
    ) );
}

// Display the After content 2 widget area in the front end.
add_action( 'beans_main_grid_after_markup', 'beans_child_after_widget_area' );
function beans_child_after_widget_area() {
	?>
	<div class="widget-after-content2 uk-block">
		<div class="uk-container uk-container-center">
			<?php echo beans_widget_area( 'after-content2' ); ?>
		</div>
	</div>
	<?php
}




/* Footer Header*/
add_action( 'widgets_init', 'beans_child_widgets_footer_header' );
function beans_child_widgets_footer_header() {
    beans_register_widget_area( array(
        'name' => 'Footer Header',
        'id' => 'footer-header',
        'description' => 'Widgets in this area will be shown in the footer header section as a grid.',
        'beans_type' => 'grid'
    ) );
}


// Display the footer header widget area in the front end.
add_action( 'beans_footer_before_markup', 'footer_header_widget_area' );
function footer_header_widget_area() {

	?>
	<div class="widget-footer-header uk-block">
		<div class="uk-container uk-container-center">
			<?php echo beans_widget_area( 'footer-header' ); ?>
		</div>
	</div>
	<?php

}




/*------- Footer -------*/
add_action( 'widgets_init', 'beans_child_widgets_footer_loop' );
function beans_child_widgets_footer_loop() {
    beans_register_widget_area( array(
        'name' => 'Footer',
        'id' => 'footer',
        'description' => 'Widgets in this area will be shown in the footer section as a grid.',
        'beans_type' => 'grid'
    ) );
}


// Display the footer widget area in the front end.
add_action( 'beans_footer_before_markup', 'footer_widget_area' );
function footer_widget_area() {

	?>
	<div class="widget-footer uk-block">
		<div class="uk-container uk-container-center">
			<?php echo beans_widget_area( 'footer' ); ?>
		</div>
	</div>
	<?php

}


add_action( 'widgets_init', 'example_widgets_init' );

function example_widgets_init() {

    // Create 3 widget area.
    for( $i = 1; $i <= 3; $i++ ) {
        beans_register_widget_area( array(
            'name' => "Widget Area {$i}",
            'id' => "example_widget_area_{$i}",
        ) );
    }

}

// Output widget area above the footer.
add_action( 'beans_footer_before_markup', 'example_footer_widget_area' );

function example_footer_widget_area() {

    ?>
    <div class="example-footer uk-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-width-medium-1-3" data-uk-grid-margin>
                <?php for( $i = 1; $i <= 3; $i++ ) : ?>
                    <div><?php echo beans_widget_area( "example_widget_area_{$i}" ); ?></div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php

}





// Register bottom widget area.
beans_add_smart_action( 'widgets_init', 'banks_register_bottom_widget_area' );

function banks_register_bottom_widget_area() {

    beans_register_widget_area( array(
        'name' => 'Bottom',
        'id' => 'bottom',
        'description' => 'Widgets in this area will be shown in the bottom section as a grid.',
        'beans_type' => 'grid'
    ) );

}


// Display the Bottom widget area in the front end.
add_action( 'beans_footer_after_markup', 'bottom_widget_area' );
function bottom_widget_area() {

	?>
	<div class="widget-bottom uk-block">
		<div class="uk-container uk-container-center">
			<?php echo beans_widget_area( 'bottom' ); ?>
		</div>
	</div>
	<?php

}