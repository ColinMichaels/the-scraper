<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 13:54
 */

use CM\Scraper;

define( 'CM_BASE_PATH', dirname( __FILE__ ) );
define( 'CM_BASE_URL', isset( $_SERVER["HTTP_HOST"] ) ? $_SERVER["HTTP_HOST"] : ( isset( $_SERVER["SERVER_NAME"] ) ? $_SERVER["SERVER_NAME"] : '_UNKNOWN_' ) );
define( 'CM_PUBLIC_PATH', CM_BASE_PATH . '/public' );
define( 'CM_PUBLIC_URL', CM_BASE_URL . '/public' );
define( 'CM_DIST_PATH', CM_BASE_PATH . '/dist' );
define( 'CM_DIST_URL', CM_BASE_URL . '/dist' );

// include the Composer autoload file
require_once CM_BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create( __DIR__ );  // Load .env file
$dotenv->overload();

if ( strpos( getenv( 'app_env' ), 'dev' ) ) {
	$whoops = new \Whoops\Run;
	$whoops->pushHandler( new \Whoops\Handler\PrettyPageHandler );
	$whoops->register();
}

$scraper = new Scraper(  CM_PUBLIC_PATH.'/site-files/dw' , 'html');

//$scraper = new Scraper(  'https://ogkcreative.com');

dump( $scraper );

$all_files = $scraper->scrape(20,20);

$contents = $all_files->find('div');

dump( $contents );



