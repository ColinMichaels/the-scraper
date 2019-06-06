<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 14:11
 */

namespace CM;

use OGK\Debug\Dumper;

class Ultilities {

	/**
	 * Die and Dump function
	 * Colin's little function for debugging
	 * Borrowed from Laravel's DD Function --> https://laravel.com/docs/5.6/helpers#method-dd
	 * Can be deleted on production
	 */

	public static function dd(...$args) {

		http_response_code(500);

		foreach ($args as $x) {
			(new Dumper)->dump($x);
		}

		die(1);
	}

	public static function dump(...$args) {

		http_response_code(500);

		foreach ($args as $x) {
			(new Dumper)->dump($x);
		}

		exit();

	}
}
