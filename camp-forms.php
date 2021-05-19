<?php
/**
 * @package TE Override
 * @version 1.0
 */
/*
Plugin Name: Camp forms Shortcode
Plugin URI: https://bellaworksweb.com
Description: Displays summer camp forms. will be rolled into core after launch.
Author: Austin Crane
Version: 1.0
Author URI: https://bellaworksweb.com
*/
/**
 * 
 * 
 */


/**
 * Temporary hook into title to display Title on Calendar Page
 * 
    
 */
/**
 * Defines alternative titles for various event views.
 *
 * @param  string $title
 * @return string
 */

/**
 * Modifes the event <title&gt; element.
 *
 * Users of Yoast's SEO plugin may wish to try replacing the below line with:
 *
 *     add_filter('wpseo_title', 'filter_events_title' );
 */
add_filter( 'tribe_events_title_tag', 'filter_events_title' );

/**
 *  Summer Camp Forms
 * 
     
 */
 
add_action('wp_enqueue_scripts', 'summercamp_style');

function summercamp_style() {
	wp_register_style( 'summercampform-styles',  plugin_dir_url( __FILE__ ) . 'summercampform-styles.css?v=1.2' );
    wp_enqueue_style( 'summercampform-styles' );
}
/**
 *  Create shortcode for forms
 * 
    [bartag foo="foo-value"]
 */
// 
function summercamp_shortcode( $atts ) {
	ob_start();
	// echo 'works';
	if( function_exists( get_field )) :

if( have_rows('camp_forms', 'option') ) : ?>
	<div class="cf-forms">
		<?php while( have_rows('camp_forms', 'option') ) : the_row();
		$title = get_sub_field('title', 'option');
		$icon = get_sub_field('icon', 'option');
		$link = get_sub_field('link', 'option');
		$pdf = get_sub_field('pdf', 'option');
		$fOrLink = get_sub_field('form_or_link', 'option');
		
		if( $fOrLink == 'link' ) {
			$nLink = $link;
		} else {
			$nLink = $pdf;
		}
		// echo '<pre>';
		// print_r($title);
		// echo '</pre>';
		 

?>

	
		<div class="cf-form">
			<?php if( $nLink ) { ?><a href="<?php echo $nLink; ?>"><?php } ?>
			<?php if( $icon ) { ?>
				<div class="cf-icon">
					<img src="<?php echo $icon['url']; ?>">
				</div>
			<?php } ?>
			<?php if( $title ) { ?>
				<h3 class="cf-title">
					<?php echo $title; ?>
				</h3>
			<?php } ?>
			<?php if( $nLink ) { ?></a><?php } ?>
		</div>
	


<?php endwhile; ?>
</div>
<?php 
endif; // end repeater loop
endif;

	// Spit everythng out
	return ob_get_clean();
}

add_shortcode( 'camp_forms', 'summercamp_shortcode' );