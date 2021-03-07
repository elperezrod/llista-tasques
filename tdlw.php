<?php
/*
	Plugin Name: Plugin Tasques
	Description: Plugin que crea tasques i les mostra a la teva web.
	Version: 1.0
	Author: ELoy Perez Rodriguez
	License: GPL3
	Text Domain: llista-tasques
	*/

	if ( ! defined( 'ABSPATH' ) ) exit;

	if( !function_exists('get_plugin_data') ){
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	
	if ( !function_exists( 'ardtdw_version' ) ) {
		function ardtdw_version() {
			$plugin_dades = get_plugin_data( __FILE__ );
			$plugin_versio = $plugin_dades['Version'];
			return $plugin_versio;
		}
	}


	if ( !function_exists( 'ardtdw_widget_scripts' ) ) {
		function ardtdw_widget_scripts() {
			wp_register_style( 'ardtdw_widget_css', plugins_url( '/public/assets/todo-widget.css', __FILE__ ), false, ardtdw_version(), 'all' );
			wp_enqueue_style( 'ardtdw_widget_css' );
		}
		add_action( 'wp_enqueue_scripts', 'ardtdw_widget_scripts' );
	}


	if ( !function_exists( 'ardtdw_widget_scripts_admin' ) ) {
		function ardtdw_widget_scripts_admin() {
			wp_register_style( 'ardtdw_widget_admincss', plugins_url( '/admin/assets/widgets.css', __FILE__ ), false, ardtdw_version(), 'all' );
			wp_enqueue_style( 'ardtdw_widget_admincss' );
		}
		add_action( 'admin_enqueue_scripts', 'ardtdw_widget_scripts_admin' );
	}


	include_once('public/todo-widget-html.php');
	require_once('admin/todo-widget.php');
