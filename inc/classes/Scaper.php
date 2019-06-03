<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 14:08
 */

namespace CM;

class Scaper {

	public function __construct() {


	}

	public function getFilesFromFolder($path){

		return scandir( $path);

	}

}
