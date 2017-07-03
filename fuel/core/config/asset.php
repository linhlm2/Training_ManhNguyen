<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * An array of paths that will be searched for assets. Each path is a
	 * RELATIVE path from the speficied url:
	 *
	 * array('assets/')
	 *
	 * These MUST include the trailing slash ('/')
	 *
	 * Paths specified here are suffixed with the sub-folder paths defined below.
	 */
	'paths' => array('assets/'),

	/**
	 * Asset Sub-folders
	 *
	 * Names for the img, js and css folders (inside the asset search path).
	 *
	 * Examples:
	 *
	 * img/
	 * js/
	 * css/
	 *
	 * This MUST include the trailing slash ('/')
	 */
	'img_dir' => 'img/',
	'js_dir' => 'js/',
	'css_dir' => 'css/',

	/**
	 * You can also specify one or more per asset-type folders. You don't have
	 * to specify all of them. 	 * Each folder is a RELATIVE path from the url
	 * speficied below:
	 *
	 * array('css' => 'assets/css/')
	 *
	 * These MUST include the trailing slash ('/')
	 *
	 * Paths specified here are expected to contain the assets they point to
	 */
	'folders' => array(
		'css' => array(
			'assets/vendors/bootstrap/dist/css/', 
			'assets/build/css/', 
			'assets/vendors/font-awesome/css/',
			'assets/vendors/jqvmap/dist/',
			'assets/vendors/bootstrap-daterangepicker/',
			'assets/vendors/nprogress/',
			'assets/vendors/iCheck/skins/flat/',
			'assets/vendors/bootstrap-progressbar/css/',
			'assets/vendors/animate.css/',
			'assets/vendors/bootstrap-datetimepicker/build/css/'
		),
		'js'  => array(
			'assets/vendors/jquery/dist/',
			'assets/vendors/bootstrap/dist/js/',
			'assets/vendors/fastclick/lib/',
			'assets/vendors/nprogress/',
			'assets//vendors/Chart.js/dist/',
			'assets/vendors/gauge.js/dist/',
			'assets/vendors/bootstrap-progressbar/',
			'assets/vendors/iCheck/',
			'assets/vendors/skycons/',
			'assets/vendors/Flot/',
			'assets/vendors/flot.orderbars/js/',
			'assets/vendors/flot-spline/js/',
			'assets/vendors/flot.curvedlines/',
			'assets/vendors/DateJS/build/',
			'assets/vendors/jqvmap/dist/',
			'assets/vendors/jqvmap/dist/maps/',
			'assets/vendors/jqvmap/examples/js/',
			'assets/vendors/moment/min/',
			'assets/vendors/bootstrap-daterangepicker/',
			'assets/build/js/',
			'assets/vendors/bootstrap-datetimepicker/build/js/'
		),
		'img' => array(),
	),

	/**
	 * URL to your Fuel root. Typically this will be your base URL:
	 *
	 * \Config::get('base_url')
	 *
	 * These MUST include the trailing slash ('/')
	 */
	'url' => \Config::get('base_url'),

	/**
	 * Whether to append the assets last modified timestamp to the url.
	 * This will aid in asset caching, and is recommended.  It will create
	 * tags like this:
	 *
	 *     <link type="text/css" rel="stylesheet" src="/assets/css/styles.css?1303443763" />
	 */
	'add_mtime' => true,

	/**
	 * The amount of indents to prefix to the generated asset tag(s).
	 */
	'indent_level' => 1,

	/**
	* What to use for indenting.
	*/
	'indent_with' => "\t",

	/**
	 * What to do when an asset method is called without a group name. If true, it will
	 * return the generated asset tag. If false, it will add it to the default group.
	 */
	'auto_render' => true,

	/**
	 * Set to true to prevent an exception from being throw when a file is not found.
	 * The asset will then be skipped.
	 */
	'fail_silently' => false,

	/**
	 * When set to true, the Asset class will always true to resolve an asset URI
	 * to a local asset, even if the asset URL is an absolute URL, for example
	 * one that points to another hostname.
	 */
	'always_resolve' => false,

);
