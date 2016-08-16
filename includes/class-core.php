<?php
/**
 * Core class.
 *
 * Contains core functionality.
 *
 * @package    BE_Full_Post_Scroll
 * @author     Bill Erickson
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2015
 */
 
class BE_Full_Post_Scroll_Core {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'init', array( $this, 'endpoint' ) );
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
		
	}
	
	/**
	 * Enqueue Scripts
	 *
	 * @since 1.0.0
	 */
	public function scripts() {

		// Only enqueue on single posts
		if( ! is_single() )
			return;	
			
		wp_enqueue_script( 'scrollspy', BE_FULL_POST_SCROLL_URL . 'assets/js/scrollspy.js', array( 'jquery' ), BE_FULL_POST_SCROLL_VERSION, true );
		wp_enqueue_script( 'history', BE_FULL_POST_SCROLL_URL . 'assets/js/jquery.history.js', array( 'jquery' ), BE_FULL_POST_SCROLL_VERSION, true );
		wp_enqueue_script( 'be-full-post-scroll', BE_FULL_POST_SCROLL_URL . 'assets/js/be-full-post-scroll.js', array( 'jquery', 'scrollspy', 'history' ), BE_FULL_POST_SCROLL_VERSION, true );

	}
	
	/**
	 * Rewrite Endpoint
	 *
	 * @since 1.0.0
	 */
	public function endpoint() {
	
		add_rewrite_endpoint( 'partial', EP_PERMALINK );

	}
	
	/**
	 * Template Redirect
	 *
	 * @since 1.0.0
	 */
	public function template_redirect() {
	
		if( is_single() && get_query_var( 'partial' ) ) {
			
			$template = get_stylesheet_directory() . '/template-parts/content-partial.php';
			$template = apply_filters( 'be_full_post_scroll_template', $template );
			include $template;
			exit;
			
		}
	} 

}