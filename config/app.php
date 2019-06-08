<?php
/**
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-07
 * Time: 00:32
 */

namespace CM;
use Dotenv\Dotenv;
use PHPHtmlParser\Dom;

$dotenv = Dotenv::create( dirname(__DIR__) );  // Load .env file
$dotenv->overload();

if ( strpos( getenv( 'app_env' ), 'dev' ) ) {
	$whoops = new \Whoops\Run;
	$whoops->pushHandler( new \Whoops\Handler\PrettyPageHandler );
	$whoops->register();
}


//  RAW DOM EXAMPLE //

/*$dom = new Dom;

dump(CM_PUBLIC_URL);

$dom->load( CM_BASE_PATH.'/public/site-files/dw/3-faqs-about-blind-spot-truck-accident-claims.html');
$contents = $dom->find('.bodyText');
dump(count($contents));
dump($contents->outerHtml);*/
