<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


/**
  * Bloqueio de renderização
  * @param [type] $url
  * @return void
  * @author Daniel Souza <daniel.souza@diletec.com.br>
  * @example https://wordpress.org/support/topic/defer-parsing-of-js-2/ WP Doc
  */
function defer_parsing_of_js ( $url ) {
	/**Se não for js retorna a url*/
	if ( FALSE === strpos( $url, '.js' ) ) return $url;

	/**Não colocar defer nas urls*/
	if ( strpos( $url, 'jquery.js' ) ) return $url;
	if ( strpos( $url, 'jquery.min.js' ) ) return $url;
	if ( strpos( $url, 'gtm.js' ) ) return $url;
	if ( strpos( $url, 'analytics.js' ) ) "$url' async ";

	/**Retorna com defer*/
	return "$url' defer ";
}
if ( FALSE === strpos( $_SERVER['REQUEST_URI'], "/wp-admin/" ) ){
	add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
}

