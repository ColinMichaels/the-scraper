<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 13:54
 */

 namespace CM;
 use SimpleExcel\SimpleExcel;

 define( 'CM_BASE_PATH', dirname( __FILE__ ) );
 define( 'CM_BASE_URL', isset( $_SERVER["HTTP_HOST"] )
	? $_SERVER["HTTP_HOST"] : ( isset( $_SERVER["SERVER_NAME"] )
		? $_SERVER["SERVER_NAME"] : '_UNKNOWN_' ) );
 define( 'CM_PUBLIC_PATH', CM_BASE_PATH . '/public' );
 define( 'CM_PUBLIC_URL', CM_BASE_URL . '/public' );
 define( 'CM_DIST_PATH', CM_BASE_PATH . '/dist' );
 define( 'CM_DIST_URL', CM_BASE_URL . '/dist' );

require_once CM_BASE_PATH . '/vendor/autoload.php';
include_once CM_BASE_PATH . '/config/app.php';

/*
 * $start_time = new \DateTime("now");
 * dump("============THE SCRAPER ============");
 * dump("START: ".$start_time->format("H:i:s a"));
*/

 /** ============================================================= **/


 $scraper = new Scraper(  CM_PUBLIC_PATH.'/site-files/dw' , 'html');

 $pages_mapped = $scraper->scrape(40,560);  // limit * set

 /// STOPPED AT 280 offset

 array_unshift($pages_mapped, array('ID', 'Title','Description','Content','Links','Videos','Slug','Keywords','Description','Robots','Path'));

 $csv = new SimpleExcel('csv');

 $csv->writer->setData($pages_mapped);

 $csv->writer->saveFile('pages-'.date('ddmmyyhi'));

 /** ============================================================= **/


/*
 * $end_time = new \DateTime("now");
 * dump("END: ".$end_time->format("H:i:s a"));
 *
 * $total_time = $end_time->diff($start_time);
 * dump("TOTAL TIME: ".$total_time->format('%f ms'));
 *
 */


